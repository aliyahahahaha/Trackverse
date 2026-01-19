<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Calculate statistics
        $ticketsAssigned = Ticket::where('assigned_to', $user->id)
            ->where('status', 'open')
            ->count();

        $ticketsCreated = Ticket::where('user_id', $user->id)->count();

        $trackersAssigned = Task::where('assigned_to', $user->id)->count();

        // Tasks don't have a created_by column, so we'll count all tasks
        $trackersCreated = 0; // Or you could count tasks from projects the user created

        return view('calendar.index', compact(
            'ticketsAssigned',
            'ticketsCreated',
            'trackersAssigned',
            'trackersCreated'
        ));
    }

    public function events()
    {
        $user = Auth::user();

        // Get tickets assigned to user
        $ticketsAssigned = Ticket::where('assigned_to', $user->id)
            ->where('status', 'open')
            ->get()
            ->map(function ($ticket) {
                return [
                    'id' => 'ticket-assigned-' . $ticket->id,
                    'title' => '[Assigned] #' . ($ticket->ticket_number ?? $ticket->id),
                    'start' => $ticket->created_at->format('Y-m-d'),
                    'backgroundColor' => '#FFA500',
                    'borderColor' => '#FFA500',
                    'url' => route('tickets.show', $ticket),
                ];
            });

        // Get tickets created by user
        $ticketsCreated = Ticket::where('user_id', $user->id)
            ->get()
            ->map(function ($ticket) {
                return [
                    'id' => 'ticket-created-' . $ticket->id,
                    'title' => '[Created] #' . ($ticket->ticket_number ?? $ticket->id),
                    'start' => $ticket->created_at->format('Y-m-d'),
                    'backgroundColor' => '#3B82F6',
                    'borderColor' => '#3B82F6',
                    'url' => route('tickets.show', $ticket),
                ];
            });

        // Get tasks assigned to user
        $trackersAssigned = Task::where('assigned_to', $user->id)
            ->get()
            ->map(function ($task) {
                return [
                    'id' => 'tracker-assigned-' . $task->id,
                    'title' => '[Assigned] ' . ($task->name ?? $task->title ?? 'Task #' . $task->id),
                    'start' => $task->due_date ? $task->due_date : $task->created_at->format('Y-m-d'),
                    'backgroundColor' => '#8B5CF6',
                    'borderColor' => '#8B5CF6',
                    'url' => route('tasks.show', $task),
                ];
            });

        // Get tasks from projects created by user (as a proxy for "created" tasks)
        $trackersCreated = Task::whereHas('project', function ($query) use ($user) {
            $query->where('created_by', $user->id);
        })
            ->get()
            ->map(function ($task) {
                return [
                    'id' => 'tracker-created-' . $task->id,
                    'title' => '[Project Task] ' . ($task->name ?? $task->title ?? 'Task #' . $task->id),
                    'start' => $task->due_date ? $task->due_date : $task->created_at->format('Y-m-d'),
                    'backgroundColor' => '#EC4899',
                    'borderColor' => '#EC4899',
                    'url' => route('tasks.show', $task),
                ];
            });

        $events = $ticketsAssigned
            ->concat($ticketsCreated)
            ->concat($trackersAssigned)
            ->concat($trackersCreated);

        return response()->json($events);
    }
}
