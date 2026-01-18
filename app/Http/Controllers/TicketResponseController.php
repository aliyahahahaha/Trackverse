<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketResponseController extends Controller
{
    public function store(Request $request, \App\Models\Ticket $ticket)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $ticket->responses()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Response added successfully.');
    }
}
