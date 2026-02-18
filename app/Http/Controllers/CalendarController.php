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
        $isPowerUser = $user->isAdmin() || $user->isDirector();

        // Calculate statistics
        $ticketsAssigned = Ticket::when(!$isPowerUser, fn($q) => $q->where('assigned_to', $user->id))
            ->where('status', 'open')
            ->count();

        $ticketsCreated = Ticket::when(!$isPowerUser, fn($q) => $q->where('user_id', $user->id))
            ->count();

        $trackersAssigned = Task::when(!$isPowerUser, fn($q) => $q->where('assigned_to', $user->id))
            ->count();

        // Tasks don't have a direct created_by, so we use projects as proxy for regular users
        // For power users, we show all tasks as "Created/System" tasks
        if ($isPowerUser) {
            $trackersCreated = Task::where('status', 'completed')->count();
        } else {
            $trackersCreated = Task::where('assigned_to', $user->id)
                ->where('status', 'completed')
                ->count();
        }

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
        $isPowerUser = $user->isAdmin() || $user->isDirector();

        // Get tickets assigned/open
        $ticketsAssigned = Ticket::when(!$isPowerUser, fn($q) => $q->where('assigned_to', $user->id))
            ->where('status', 'open')
            ->get()
            ->map(function ($ticket) use ($isPowerUser) {
                return [
                    'id' => 'ticket-assigned-' . $ticket->id,
                    'title' => ($isPowerUser ? '[Open] ' : '[Assigned] ') . '#' . ($ticket->ticket_number ?? $ticket->id),
                    'start' => $ticket->created_at->format('Y-m-d'),
                    'backgroundColor' => '#FFA500',
                    'borderColor' => '#FFA500',
                    'url' => route('tickets.show', $ticket),
                ];
            });

        // Get tickets created/all
        $ticketsCreated = Ticket::when(!$isPowerUser, fn($q) => $q->where('user_id', $user->id))
            ->get()
            ->map(function ($ticket) use ($isPowerUser) {
                return [
                    'id' => 'ticket-created-' . $ticket->id,
                    'title' => ($isPowerUser ? '[Ticket] ' : '[Created] ') . '#' . ($ticket->ticket_number ?? $ticket->id),
                    'start' => $ticket->created_at->format('Y-m-d'),
                    'backgroundColor' => '#3B82F6',
                    'borderColor' => '#3B82F6',
                    'url' => route('tickets.show', $ticket),
                ];
            });

        // Get tasks assigned
        $trackersAssigned = Task::when(!$isPowerUser, fn($q) => $q->where('assigned_to', $user->id))
            ->get()
            ->map(function ($task) use ($isPowerUser) {
                return [
                    'id' => 'tracker-assigned-' . $task->id,
                    'title' => ($isPowerUser ? '[Task] ' : '[Assigned] ') . ($task->name ?? $task->title ?? 'Task #' . $task->id),
                    'start' => $task->due_date ? $task->due_date : $task->created_at->format('Y-m-d'),
                    'backgroundColor' => '#8B5CF6',
                    'borderColor' => '#8B5CF6',
                    'url' => route('tasks.show', $task),
                ];
            });

        $trackersCreatedQuery = Task::where('status', 'completed');
        if (!$isPowerUser) {
            $trackersCreatedQuery->where('assigned_to', $user->id);
        }

        $trackersCreated = $trackersCreatedQuery->get()
            ->map(function ($task) use ($isPowerUser) {
                return [
                    'id' => 'tracker-completed-' . $task->id,
                    'title' => '[Completed] ' . ($task->name ?? $task->title ?? 'Task #' . $task->id),
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
