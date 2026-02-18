<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TicketClosed extends Notification
{
    use Queueable;

    public $ticket;
    public $closer;

    /**
     * Create a new notification instance.
     */
    public function __construct(Ticket $ticket, $closer)
    {
        $this->ticket = $ticket;
        $this->closer = $closer;
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
            'title' => 'Ticket Closed',
            'message' => "Ticket #{$this->ticket->id}: '{$this->ticket->title}' has been closed by {$this->closer->name}",
            'action_url' => route('tickets.show', $this->ticket->id),
            'type' => 'ticket_closed',
        ];
    }
}
