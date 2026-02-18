<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->isDirector() || $user->id === $task->project->created_by || $task->project->members->contains($user->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('create_tasks');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        // Must be a project member or owner
        $isMember = $user->id === $task->project->created_by || $task->project->members->contains($user->id);

        if (!$isMember) {
            return false;
        }

        // Admins and Directors are handled by 'before' or explicitly match
        if ($user->isAdmin() || $user->isDirector()) {
            return true;
        }

        // If they have full edit permission (TLs/Admins)
        if ($user->hasPermission('edit_tasks')) {
            return true;
        }

        // If they only have status update permission, they must be the assignee
        if ($user->hasPermission('update_task_status')) {
            return $task->assigned_to === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->project->created_by || $user->hasPermission('delete_tasks');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return $user->id === $task->project->created_by || $user->hasPermission('delete_tasks');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return $user->id === $task->project->created_by || $user->hasPermission('delete_tasks');
    }
}
