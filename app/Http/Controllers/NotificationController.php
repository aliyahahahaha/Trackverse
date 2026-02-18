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
        $user = Auth::user();
        if ($user->isAdmin() || $user->isDirector()) {
            $notification = \Illuminate\Notifications\DatabaseNotification::find($id);
        } else {
            $notification = $user->notifications()->where('id', $id)->first();
        }

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
        $user = Auth::user();
        if ($user->isAdmin() || $user->isDirector()) {
            \Illuminate\Notifications\DatabaseNotification::whereNull('read_at')->update(['read_at' => now()]);
        } else {
            $user->unreadNotifications->markAsRead();
        }

        return back()->with('success', 'All notifications marked as read.');
    }
}
