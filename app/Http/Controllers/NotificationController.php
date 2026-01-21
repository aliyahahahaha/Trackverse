<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Mark a specific notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return back()->with('success', 'All notifications marked as read.');
    }
}
