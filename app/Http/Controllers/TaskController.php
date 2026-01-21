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

        if ($user->isAdmin()) {
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
                ->whereHas('project', function ($q) use ($user) {
                    $q->whereHas('members', fn($q) => $q->where('user_id', $user->id));
                })
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
        Gate::authorize('view', $project);
        $users = $project->members;
        return view('tasks.create', compact('project', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        Gate::authorize('view', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:pending,in_progress,completed',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $task = new Task($validated);
        $task->project_id = $project->id;
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

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:pending,in_progress,completed',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $originalAssignee = $task->assigned_to;
        $task->update($validated);

        if ($task->assigned_to && $task->assigned_to != $originalAssignee && $task->assigned_to != auth()->id()) {
            User::find($task->assigned_to)?->notify(new \App\Notifications\TaskAssigned($task));
        }

        return redirect()->route('projects.show', $task->project)->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('view', $task->project); // Assuming project members can delete tasks for now, or restrict to creator/admin
        $project = $task->project;
        $task->delete();

        return redirect()->route('projects.show', $project)->with('success', 'Task deleted successfully.');
    }
}
