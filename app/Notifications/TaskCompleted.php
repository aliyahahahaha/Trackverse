<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskCompleted extends Notification
{
    use Queueable;

    public $task;
    public $completer;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task, $completer)
    {
        $this->task = $task;
        $this->completer = $completer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Task Completed',
            'message' => "Task '{$this->task->name}' has been marked as completed by {$this->completer->name}",
            'action_url' => route('tasks.show', $this->task->id),
            'type' => 'task_completed',
        ];
    }
}
