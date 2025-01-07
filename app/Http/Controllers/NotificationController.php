<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function getNotifications()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('components.navbar', compact('notifications'));
    }

    public function handleNotification($id, $action)
    {
        $notification = Notification::findOrFail($id);

        if ($action === 'accept') {
            Friend::where('user_id', $notification->sender_id)
                ->where('friend_id', $notification->user_id)
                ->update(['status' => 'accepted']);
        } elseif ($action === 'decline') {
            Friend::where('user_id', $notification->sender_id)
                ->where('friend_id', $notification->user_id)
                ->delete();
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Action performed successfully.');
    }

}
