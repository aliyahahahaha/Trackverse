<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberAvailability;

class AvailabilityController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:present,medical_leave,vacation',
        ]);

        \App\Models\MemberAvailability::updateOrCreate(
            ['user_id' => auth()->id(), 'date' => now()->toDateString()],
            ['status' => $validated['status']]
        );

        return back()->with('success', 'Availability status updated successfully.');
    }
}
