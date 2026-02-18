<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AvailabilityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Temporary route to clear cache - REMOVE AFTER USE
Route::get('/clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');

    return 'Cache cleared successfully! You can now close this page and refresh your dashboard.';
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        // Projects base query based on role
        if ($user->isAdmin() || $user->isDirector()) {
            $projectQuery = \App\Models\Project::query();
            $taskQuery = \App\Models\Task::query();
        } elseif ($user->isTeamLeader()) {
            // Team Leader sees projects they created or are members of
            $projectQuery = \App\Models\Project::where(function ($q) use ($user) {
                $q->whereHas('members', fn($q) => $q->where('user_id', $user->id))
                    ->orWhere('created_by', $user->id);
            });
            $taskQuery = \App\Models\Task::whereHas('project', function ($q) use ($user) {
                $q->whereHas('members', fn($q) => $q->where('user_id', $user->id))
                    ->orWhere('created_by', $user->id);
            });
        } else {
            // User sees only projects they are members of
            $projectQuery = \App\Models\Project::whereHas('members', fn($q) => $q->where('user_id', $user->id));
            $taskQuery = \App\Models\Task::whereHas('project', function ($q) use ($user) {
                $q->whereHas('members', fn($q) => $q->where('user_id', $user->id));
            });
        }

        // Projects stats
        $totalProjects = (clone $projectQuery)->count();
        $activeProjects = (clone $projectQuery)->where('status', 'active')->count();

        // Tasks stats
        $totalTasks = (clone $taskQuery)->count();
        $pendingTasks = (clone $taskQuery)->where('status', '!=', 'completed')->count();

        // Recent Projects
        $recentProjects = (clone $projectQuery)->latest()
            ->take(5)
            ->get();

        // Upcoming Tasks
        $upcomingTasks = (clone $taskQuery)->whereNotNull('due_date')
            ->where('status', '!=', 'completed')
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        // Announcements for slider
        $announcements = \App\Models\Announcement::latest()->take(5)->get();

        return view('dashboard', [
            'title' => 'Dashboard',
            'totalProjects' => $totalProjects,
            'activeProjects' => $activeProjects,
            'totalTasks' => $totalTasks,
            'pendingTasks' => $pendingTasks,
            'recentProjects' => $recentProjects,
            'upcomingTasks' => $upcomingTasks,
            'announcements' => $announcements,
            'projects' => (clone $projectQuery)->where('status', 'active')
                ->orderBy('name')
                ->get()
        ]);
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('projects', \App\Http\Controllers\ProjectController::class);
    Route::get('tasks', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
    Route::resource('projects.tasks', \App\Http\Controllers\TaskController::class)->shallow();
    Route::resource('projects.members', \App\Http\Controllers\ProjectMemberController::class)->only(['index', 'store', 'destroy']);

    Route::resource('tickets', \App\Http\Controllers\TicketController::class);
    Route::post('tickets/{ticket}/responses', [\App\Http\Controllers\TicketResponseController::class, 'store'])->name('tickets.responses.store');
    Route::patch('tickets/{ticket}/close', [\App\Http\Controllers\TicketController::class, 'close'])->name('tickets.close');

    // Add POST route for updating availability
    Route::post('/availability', [AvailabilityController::class, 'update'])->name('availability.update');

    // Calendar routes
    Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [\App\Http\Controllers\CalendarController::class, 'events'])->name('calendar.events');

    // Leaderboard route
    Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('leaderboard.index');

    Route::resource('announcements', \App\Http\Controllers\AnnouncementController::class);
    // Notifications
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    Route::resource('permissions', \App\Http\Controllers\PermissionsController::class)->only(['index', 'create', 'store', 'update']);
});

require __DIR__ . '/auth.php';
