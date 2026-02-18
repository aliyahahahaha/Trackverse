<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin() || $user->isDirector()) {
            $ownedProjects = Project::where('created_by', $user->id)->latest()->get();
            $joinedProjects = Project::where('created_by', '!=', $user->id)
                ->whereHas('members', fn($q) => $q->where('user_id', $user->id))
                ->latest()->get();
            $allOtherProjects = Project::where('created_by', '!=', $user->id)
                ->whereDoesntHave('members', fn($q) => $q->where('user_id', $user->id))
                ->latest()->get();

            // For Admin, we'll merge "all other" into joined for display, or handle separately
            $joinedProjects = $joinedProjects->concat($allOtherProjects);
        } elseif ($user->isTeamLeader()) {
            $ownedProjects = $user->projects()->latest()->get();
            $joinedProjects = $user->joinedProjects()->latest()->get();
        } else {
            $ownedProjects = collect();
            $joinedProjects = $user->joinedProjects()->latest()->get();
        }

        return view('projects.index', [
            'projects' => $ownedProjects,
            'joinedProjects' => $joinedProjects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Project::class);
        $users = \App\Models\User::orderBy('name')->get();
        return view('projects.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Project::class);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:planning,active,on_hold,completed',
        ]);

        $project = new Project($validated);
        $project->created_by = Auth::id();
        $project->save();

        // Add creator and selected members
        $memberIds = array_filter($request->input('members', []));
        if (!in_array(Auth::id(), $memberIds)) {
            $memberIds[] = Auth::id();
        }
        $project->members()->sync($memberIds);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        Gate::authorize('view', $project);
        $project->load(['tasks', 'members']);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        Gate::authorize('update', $project);
        $users = \App\Models\User::orderBy('name')->get();
        return view('projects.edit', compact('project', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        Gate::authorize('update', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:planning,active,on_hold,completed',
        ]);

        $project->update($validated);

        if ($request->has('members')) {
            $memberIds = array_filter($request->input('members', []));
            $project->members()->sync($memberIds);
        }

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Gate::authorize('delete', $project);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
