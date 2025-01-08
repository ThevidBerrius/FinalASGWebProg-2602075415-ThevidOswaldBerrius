<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Events\MessageSent;

class MessageController extends Controller
{
    //
    public function showMessages($friendId)
    {
        $userId = auth()->id();

        // Retrieve the friend and messages
        $friend = User::findOrFail($friendId);
        $messages = Message::where(function ($query) use ($userId, $friendId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $friendId);
        })->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('sender_id', $friendId)
                ->where('receiver_id', $userId);
        })->get();

        return view('pages.messages', compact('messages', 'friend'));
    }

    public function sendMessage(Request $request, $friendId)
    {
        $userId = auth()->id();

        $message = new Message();
        $message->sender_id = $userId;
        $message->receiver_id = $friendId;
        $message->content = $request->input('content');
        $message->save();

        $notification = new Notification();
        $notification->user_id = $friendId;
        $notification->sender_id = $userId;
        $notification->content = 'You have a new message from ' . auth()->user()->name;
        $notification->type = 'message';
        $notification->save();

        return redirect()->route('messages.show', ['friendId' => $friendId])->with('success', __('lang.message_sent'));
    }

    public function showAndDeleteNotification($friendId, $notificationId)
    {
        Notification::findOrFail($notificationId)->delete();

        $messages = Message::where(function ($query) use ($friendId) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $friendId);
        })->orWhere(function ($query) use ($friendId) {
            $query->where('sender_id', $friendId)
                ->where('receiver_id', auth()->id());
        })->get();

        $friend = User::findOrFail($friendId);

        return view('pages.messages', compact('messages', 'friend'));
    }
}
