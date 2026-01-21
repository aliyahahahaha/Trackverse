<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskDeadlineReminder;

class SendTaskDeadlineReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-deadline-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for tasks due soon';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find tasks due tomorrow that are not completed
        $tasks = Task::where('status', '!=', 'completed')
            ->whereDate('due_date', now()->addDay()) // Remind 1 day before
            ->whereNotNull('assigned_to')
            ->get();

        $count = 0;
        foreach ($tasks as $task) {
            $user = User::find($task->assigned_to);
            if ($user) {
                $user->notify(new TaskDeadlineReminder($task));
                $count++;
            }
        }

        $this->info("Sent {$count} deadline reminders.");
    }
}
