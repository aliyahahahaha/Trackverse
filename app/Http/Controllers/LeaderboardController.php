<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaderboardController extends Controller
{
    /**
     * Display the leaderboard page
     */
    public function index(Request $request)
    {
        // Get filter parameters
        $view = $request->get('view', 'monthly'); // monthly, weekly, all-time
        $month = $request->get('month', now()->format('Y-m'));

        // Calculate date range based on view type
        $dateRange = $this->getDateRange($view, $month);

        // Get all users with their performance data
        $users = User::all()->map(function ($user) use ($dateRange) {
            $stats = $this->calculateUserStats($user, $dateRange);
            return [
                'user' => $user,
                'tasks_completed' => $stats['tasks'],
                'tickets_completed' => $stats['tickets'],
                'remarks' => $stats['remarks'],
                'total_points' => $stats['points'],
            ];
        });

        // Sort by points (descending), then tasks, then tickets
        $rankings = $users->sortByDesc(function ($item) {
            return [
                $item['total_points'],
                $item['tasks_completed'],
                $item['tickets_completed']
            ];
        })->values();

        // Get top 3
        $topThree = $rankings->take(3);

        // Find current user's rank and stats
        $currentUserId = auth()->id();
        $myRank = null;
        $myStats = null;

        foreach ($rankings as $index => $ranking) {
            if ($ranking['user']->id === $currentUserId) {
                $myRank = $index + 1;
                $myStats = $ranking;
                break;
            }
        }

        // Calculate participants count
        $participantsCount = $rankings->count();

        // Format display text for current period
        $periodText = $this->getPeriodText($view, $month);

        return view('leaderboard.index', [
            'title' => 'Leaderboard',
            'topThree' => $topThree,
            'rankings' => $rankings,
            'myRank' => $myRank,
            'myStats' => $myStats,
            'participantsCount' => $participantsCount,
            'view' => $view,
            'month' => $month,
            'periodText' => $periodText,
        ]);
    }

    /**
     * Calculate user statistics for the given date range
     */
    private function calculateUserStats(User $user, array $dateRange)
    {
        $startDate = $dateRange['start'];
        $endDate = $dateRange['end'];

        // Count completed tasks
        $tasksCompleted = Task::where('assigned_to', $user->id)
            ->where('status', 'completed')
            ->when($startDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('updated_at', [$startDate, $endDate]);
            })
            ->count();

        // Count completed tickets (assigned to user)
        $ticketsCompleted = Ticket::where('assigned_to', $user->id)
            ->where('status', 'closed')
            ->when($startDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('updated_at', [$startDate, $endDate]);
            })
            ->count();

        // Count remarks/responses made by user
        $remarks = TicketResponse::where('user_id', $user->id)
            ->when($startDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->count();

        // Calculate points
        // Task completed = 10 points
        // Ticket completed = 5 points
        // Remark = 1 point
        $points = ($tasksCompleted * 10) + ($ticketsCompleted * 5) + ($remarks * 1);

        return [
            'tasks' => $tasksCompleted,
            'tickets' => $ticketsCompleted,
            'remarks' => $remarks,
            'points' => $points,
        ];
    }

    /**
     * Get date range based on view type
     */
    private function getDateRange(string $view, string $month)
    {
        switch ($view) {
            case 'weekly':
                // Current week (Monday to Sunday)
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;

            case 'monthly':
                // Selected month
                $date = Carbon::createFromFormat('Y-m', $month);
                $start = $date->copy()->startOfMonth();
                $end = $date->copy()->endOfMonth();
                break;

            case 'all-time':
            default:
                // No date filter
                return ['start' => null, 'end' => null];
        }

        return [
            'start' => $start,
            'end' => $end,
        ];
    }

    /**
     * Get human-readable period text
     */
    private function getPeriodText(string $view, string $month)
    {
        switch ($view) {
            case 'weekly':
                $start = Carbon::now()->startOfWeek()->format('M d');
                $end = Carbon::now()->endOfWeek()->format('M d, Y');
                return "Week of {$start} - {$end}";

            case 'monthly':
                return Carbon::createFromFormat('Y-m', $month)->format('F Y');

            case 'all-time':
            default:
                return 'All Time';
        }
    }
}
