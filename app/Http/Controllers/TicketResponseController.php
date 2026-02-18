<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketResponseAdded;

class TicketResponseController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        if (auth()->user()->isDirector()) {
            abort(403, 'Directors cannot add responses.');
        }

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $response = $ticket->responses()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        // Send Notifications
        $this->notifyTicketStakeholders($ticket, $validated['content']);

        return back()->with('success', 'Response added successfully.');
    }

    private function notifyTicketStakeholders(Ticket $ticket, string $content)
    {
        $user = auth()->user();
        $recipients = collect();

        // 1. Add the reporter (if not current user)
        if ($ticket->user_id && $ticket->user_id != $user->id) {
            $recipients->push($ticket->user);
        }

        // 2. Add the assignee (if not current user)
        if ($ticket->assigned_to && $ticket->assigned_to != $user->id) {
            $recipients->push($ticket->assignedTo);
        }

        // 3. Add Admins and Directors (if not current user)
        $adminsAndDirectors = User::whereIn('role', [User::ROLE_ADMIN, User::ROLE_DIRECTOR])
            ->where('id', '!=', $user->id)
            ->get();

        $recipients = $recipients->merge($adminsAndDirectors)->unique('id')->filter();

        foreach ($recipients as $recipient) {
            $recipient->notify(new TicketResponseAdded($ticket, $user, $content));
        }
    }
}
