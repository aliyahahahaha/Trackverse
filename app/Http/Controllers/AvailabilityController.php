<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberAvailability;

class AvailabilityController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:available,busy,on_leave',
        ]);

        MemberAvailability::updateOrCreate(
            ['user_id' => auth()->id(), 'date' => now()->toDateString()],
            ['status' => $validated['status']]
        );

        $statusLabel = ucwords(str_replace('_', ' ', $validated['status']));
        return back()->with('success', "Availability status updated to {$statusLabel}");
    }
}
