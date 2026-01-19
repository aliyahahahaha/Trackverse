<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
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
        if ($user->isAdmin()) {
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
            ->whereIn('project_id', $projectIds)
            ->latest()
            ->simplePaginate(10);

        return view('tickets.index', compact('tickets', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
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
        $allUsers = \App\Models\User::with('todayAvailability')->orderBy('name')->get();

        return view('tickets.create', compact('projects', 'allUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        $this->authorizeTicketAccess($ticket);
        $ticket->load(['responses.user', 'user', 'project', 'assignedTo']);
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorizeTicketAccess($ticket);

        $user = auth()->user();
        if ($user->isAdmin()) {
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
        $allUsers = \App\Models\User::with('todayAvailability')->orderBy('name')->get();

        return view('tickets.edit', compact('ticket', 'projects', 'allUsers'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->authorizeTicketAccess($ticket);
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

        $ticket->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'category' => $validated['category'],
            'status' => $validated['status'],
            'assigned_to' => $validated['assigned_to'],
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    public function close(Ticket $ticket)
    {
        $this->authorizeTicketAccess($ticket);

        $ticket->update(['status' => 'closed']);

        return back()->with('success', 'Ticket closed successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorizeTicketAccess($ticket);
        if ($ticket->attachment_path) {
            Storage::disk('public')->delete($ticket->attachment_path);
        }
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }

    private function authorizeTicketAccess(Ticket $ticket)
    {
        $user = auth()->user();
        if ($user->isAdmin())
            return;

        // Check if user is member of the project
        if (!$ticket->project->members->contains($user->id) && $ticket->project->created_by !== $user->id) {
            abort(403);
        }
    }
}
