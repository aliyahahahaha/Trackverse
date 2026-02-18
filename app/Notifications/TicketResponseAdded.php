<?php

namespace App\Notifications;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TicketResponseAdded extends Notification
{
    use Queueable;

    public $ticket;
    public $responder;
    public $content;

    /**
     * Create a new notification instance.
     */
    public function __construct(Ticket $ticket, User $responder, string $content)
    {
        $this->ticket = $ticket;
        $this->responder = $responder;
        $this->content = $content;
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
        $shortContent = mb_strimwidth($this->content, 0, 50, "...");

        return [
            'title' => 'New Ticket Response',
            'message' => "{$this->responder->name} responded to ticket #{$this->ticket->id}: '{$this->ticket->title}'",
            'preview' => $shortContent,
            'action_url' => route('tickets.show', $this->ticket->id),
            'type' => 'ticket_response',
        ];
    }
}
