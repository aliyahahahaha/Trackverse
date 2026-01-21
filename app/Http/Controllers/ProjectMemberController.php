<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        Gate::authorize('view', $project);
        $members = $project->members;
        $users = User::whereNotIn('id', $members->pluck('id'))
            ->where('id', '!=', $project->created_by)
            ->get();

        return view('projects.members.index', compact('project', 'members', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        Gate::authorize('update', $project); // Only creator/admin can add members

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        if ($project->members()->where('user_id', $validated['user_id'])->exists()) {
            return back()->with('error', 'User is already a member.');
        }

        $project->members()->attach($validated['user_id']);

        User::find($validated['user_id'])?->notify(new \App\Notifications\ProjectAssigned($project));

        return back()->with('success', 'Member added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, User $member)
    {
        Gate::authorize('update', $project); // Only creator/admin can remove members

        $project->members()->detach($member->id);

        return back()->with('success', 'Member removed successfully.');
    }
}
