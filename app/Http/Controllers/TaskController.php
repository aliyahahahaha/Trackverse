<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin() || $user->isDirector()) {
            $tasks = Task::with(['project', 'assignee'])->latest()->paginate(10);
        } elseif ($user->isTeamLeader()) {
            $tasks = Task::with(['project', 'assignee'])
                ->whereHas('project', function ($q) use ($user) {
                    $q->whereHas('members', fn($q) => $q->where('user_id', $user->id))
                        ->orWhere('created_by', $user->id);
                })
                ->latest()
                ->paginate(10);
        } else {
            $tasks = Task::with(['project', 'assignee'])
                ->where('assigned_to', $user->id)
                ->latest()
                ->paginate(10);
        }

        return view('tasks.index', compact('tasks'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        if (auth()->user()->isDirector() || !auth()->user()->hasPermission('create_tasks')) {
            abort(403, 'You do not have permission to create tasks.');
        }
        Gate::authorize('view', $project);
        $users = $project->members;
        return view('tasks.create', compact('project', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        if (!auth()->user()->hasPermission('create_tasks')) {
            abort(403, 'You do not have permission to create tasks.');
        }
        Gate::authorize('view', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:pending,in_progress,completed',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $task = new Task($validated);
        $task->project_id = $project->id;
        $task->created_by = auth()->id();
        $task->save();

        if ($task->assigned_to && $task->assigned_to != auth()->id()) {
            User::find($task->assigned_to)?->notify(new \App\Notifications\TaskAssigned($task));
        }

        return redirect()->route('projects.show', $project)->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        Gate::authorize('view', $task->project);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $user = auth()->user();

        if (!$user->isAdmin() && !$user->isDirector()) {
            if (!$user->hasPermission('edit_tasks') && !$user->hasPermission('update_task_status')) {
                abort(403, 'You do not have permission to edit this task.');
            }

            // If they only have status update permission, they must be the assignee
            if (!$user->hasPermission('edit_tasks') && $task->assigned_to !== $user->id) {
                abort(403, 'You can only update the status of tasks assigned to you.');
            }
        }

        Gate::authorize('view', $task->project);
        $users = $task->project->members;
        return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        Gate::authorize('view', $task->project);
        $user = auth()->user();

        $oldStatus = $task->status;

        if ($user->hasPermission('edit_tasks')) {
            // Full update allowed
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|string|in:pending,in_progress,completed',
                'assigned_to' => 'nullable|exists:users,id',
                'due_date' => 'nullable|date',
            ]);

            $originalAssignee = $task->assigned_to;
            $task->update($validated);

            if ($task->assigned_to && $task->assigned_to != $originalAssignee && $task->assigned_to != auth()->id()) {
                User::find($task->assigned_to)?->notify(new \App\Notifications\TaskAssigned($task));
            }
        } elseif ($user->hasPermission('update_task_status')) {
            // Check if they are the assignee
            if ($task->assigned_to !== $user->id) {
                abort(403, 'You can only update the status of tasks assigned to you.');
            }

            // Only update status
            $validated = $request->validate([
                'status' => 'required|string|in:pending,in_progress,completed',
            ]);
            $task->update(['status' => $validated['status']]);
        } else {
            abort(403, 'You do not have permission to update this task.');
        }

        // Send notifications if task is completed
        if ($task->status === 'completed' && $oldStatus !== 'completed') {
            $recipients = collect();

            // Add the person who assigned the task
            if ($task->created_by && $task->created_by != auth()->id()) {
                $recipients->push(User::find($task->created_by));
            }

            // Add Admins and Directors
            $adminsAndDirectors = User::whereIn('role', [User::ROLE_ADMIN, User::ROLE_DIRECTOR])
                ->where('id', '!=', auth()->id())
                ->get();

            $recipients = $recipients->merge($adminsAndDirectors)->unique('id')->filter();

            foreach ($recipients as $recipient) {
                $recipient->notify(new \App\Notifications\TaskCompleted($task, auth()->user()));
            }
        }

        return redirect()->route('projects.show', $task->project)->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (!auth()->user()->hasPermission('delete_tasks')) {
            abort(403, 'You do not have permission to delete tasks.');
        }
        Gate::authorize('view', $task->project);
        $project = $task->project;
        $task->delete();

        return redirect()->route('projects.show', $project)->with('success', 'Task deleted successfully.');
    }
}
