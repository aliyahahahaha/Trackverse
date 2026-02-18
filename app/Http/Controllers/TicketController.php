<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketClosed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Projects user can access
        if ($user->isAdmin() || $user->isDirector()) {
            $projectQuery = \App\Models\Project::query();
        } elseif ($user->isTeamLeader()) {
            $projectQuery = \App\Models\Project::where(function ($q) use ($user) {
                $q->whereHas('members', fn($q) => $q->where('user_id', $user->id))
                    ->orWhere('created_by', $user->id);
            });
        } else {
            $projectQuery = \App\Models\Project::whereHas('members', fn($q) => $q->where('user_id', $user->id));
        }

        $projects = (clone $projectQuery)->where('status', 'active')->orderBy('name')->get();
        $projectIds = (clone $projectQuery)->pluck('id');

        $tickets = Ticket::with(['user', 'project', 'assignedTo'])
            ->where(function ($query) use ($projectIds, $user) {
                $query->whereIn('project_id', $projectIds)
                    ->orWhere('assigned_to', $user->id)
                    ->orWhere('user_id', $user->id); // Also show tickets they reported
            })
            ->latest()
            ->paginate(10);

        return view('tickets.index', compact('tickets', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        if (!auth()->user()->hasPermission('create_tickets')) {
            abort(403, 'You do not have permission to create tickets.');
        }

        if ($user->isAdmin() || $user->isDirector()) {
            $projectQuery = \App\Models\Project::query();
        } elseif ($user->isTeamLeader()) {
            $projectQuery = \App\Models\Project::where(function ($q) use ($user) {
                $q->whereHas('members', fn($q) => $q->where('user_id', $user->id))
                    ->orWhere('created_by', $user->id);
            });
        } else {
            $projectQuery = \App\Models\Project::whereHas('members', fn($q) => $q->where('user_id', $user->id));
        }

        $projects = $projectQuery->with(['members.todayAvailability'])->where('status', 'active')->orderBy('name')->get();
        $allUsers = User::with('todayAvailability')->orderBy('name')->get();

        return view('tickets.create', compact('projects', 'allUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission('create_tickets')) {
            abort(403, 'You do not have permission to create tickets.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'category' => 'required|string|max:255',
            'assigned_to' => 'nullable|exists:users,id',
            'attachment' => 'nullable|file|max:10240', // 10MB max
        ]);

        // Security check: ensure user can access this project
        $user = auth()->user();
        $project = \App\Models\Project::find($validated['project_id']);
        if (!$user->isAdmin()) {
            $isMember = $project->members->contains($user->id);
            $isCreator = $project->created_by === $user->id;
            if (!$isMember && !$isCreator) {
                abort(403, 'Unauthorized access to this project.');
            }
        }

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'project_id' => $validated['project_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'category' => $validated['category'],
            'assigned_to' => $validated['assigned_to'] ?? null,
        ]);

        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
            $ticket->addMediaFromRequest('attachment')->toMediaCollection('attachments');
        }

        if ($ticket->assigned_to && $ticket->assigned_to != auth()->id()) {
            User::find($ticket->assigned_to)?->notify(new \App\Notifications\TicketAssigned($ticket));
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        $this->authorizeTicketAccess($ticket, 'view');
        $ticket->load(['responses.user', 'user', 'project', 'assignedTo']);
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorizeTicketAccess($ticket, 'edit');

        $user = auth()->user();
        if ($user->isAdmin() || $user->isDirector()) {
            $projectQuery = \App\Models\Project::query();
        } elseif ($user->isTeamLeader()) {
            $projectQuery = \App\Models\Project::where(function ($q) use ($user) {
                $q->whereHas('members', fn($q) => $q->where('user_id', $user->id))
                    ->orWhere('created_by', $user->id);
            });
        } else {
            $projectQuery = \App\Models\Project::whereHas('members', fn($q) => $q->where('user_id', $user->id));
        }

        $projects = $projectQuery->with(['members.todayAvailability'])->where('status', 'active')->orderBy('name')->get();
        $allUsers = User::with('todayAvailability')->orderBy('name')->get();

        return view('tickets.edit', compact('ticket', 'projects', 'allUsers'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->authorizeTicketAccess($ticket, 'update');
        $user = auth()->user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'category' => 'required|string|max:255',
            'status' => 'required|in:open,in_progress,resolved,closed',
            'assigned_to' => 'nullable|exists:users,id',
            'attachment' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
            $ticket->addMediaFromRequest('attachment')->toMediaCollection('attachments');
        }

        $originalAssignee = $ticket->assigned_to;

        $oldStatus = $ticket->status;

        $ticket->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'category' => $validated['category'],
            'status' => $validated['status'],
            'assigned_to' => $validated['assigned_to'],
        ]);

        if ($ticket->assigned_to && $ticket->assigned_to != $originalAssignee && $ticket->assigned_to != auth()->id()) {
            User::find($ticket->assigned_to)?->notify(new \App\Notifications\TicketAssigned($ticket));
        }

        // Send notifications if ticket is closed or resolved
        if (in_array($ticket->status, ['resolved', 'closed']) && !in_array($oldStatus, ['resolved', 'closed'])) {
            $this->notifyTicketStakeholders($ticket);
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    public function close(Ticket $ticket)
    {
        $this->authorizeTicketAccess($ticket, 'close');

        $oldStatus = $ticket->status;
        $ticket->update(['status' => 'closed']);

        if ($oldStatus !== 'closed') {
            $this->notifyTicketStakeholders($ticket);
        }

        return back()->with('success', 'Ticket closed successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        if (!auth()->user()->hasPermission('delete_tickets')) {
            abort(403, 'You do not have permission to delete tickets.');
        }
        $this->authorizeTicketAccess($ticket, 'delete');
        if ($ticket->attachment_path) {
            Storage::disk('public')->delete($ticket->attachment_path);
        }
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }

    private function authorizeTicketAccess(Ticket $ticket, $action = 'view')
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return;
        }

        if ($user->isDirector()) {
            if ($action === 'view') {
                return;
            }
            abort(403, 'Directors have view-only access.');
        }

        // Check if user is member of the project, reporter, or assigned user
        $isMember = $ticket->project->members->contains($user->id);
        $isCreator = $ticket->project->created_by === $user->id;
        $isReporter = $ticket->user_id === $user->id;
        $isAssigned = $ticket->assigned_to === $user->id;

        if (!$isMember && !$isCreator && !$isReporter && !$isAssigned) {
            abort(403, 'Unauthorized access to this project\'s tickets.');
        }

        // For modifying actions, check if user is the reporter or assigned user
        if (in_array($action, ['edit', 'delete', 'update'])) {
            if ($ticket->user_id !== $user->id) {
                abort(403, 'You can only modify tickets that you reported.');
            }
        }

        // For closing, allow reporter, assigned user, or team leaders in the project
        if ($action === 'close') {
            $canClose = $ticket->user_id === $user->id || $ticket->assigned_to === $user->id;

            // Team leaders can close tickets in projects they manage
            if (!$canClose && $user->isTeamLeader()) {
                $canClose = $isMember || $isCreator;
            }

            if (!$canClose) {
                abort(403, 'You can only close tickets that you reported, are assigned to, or manage.');
            }
        }
    }

    private function notifyTicketStakeholders(Ticket $ticket)
    {
        $recipients = collect();

        // Add the reporter
        if ($ticket->user_id && $ticket->user_id != auth()->id()) {
            $recipients->push(User::find($ticket->user_id));
        }

        // Add Admins and Directors
        $adminsAndDirectors = User::whereIn('role', [User::ROLE_ADMIN, User::ROLE_DIRECTOR])
            ->where('id', '!=', auth()->id())
            ->get();

        $recipients = $recipients->merge($adminsAndDirectors)->unique('id')->filter();

        foreach ($recipients as $recipient) {
            $recipient->notify(new TicketClosed($ticket, auth()->user()));
        }
    }
}
