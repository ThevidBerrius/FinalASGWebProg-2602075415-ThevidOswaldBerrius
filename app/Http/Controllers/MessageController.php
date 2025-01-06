<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //

    // In MessageController
    public function showMessages($friendId)
    {
        $currentUserId = auth()->id();

        // Fetch messages between the current user and the selected friend
        $messages = Message::where(function ($query) use ($currentUserId, $friendId) {
            $query->where('sender_id', $currentUserId)
                ->where('receiver_id', $friendId);
        })
            ->orWhere(function ($query) use ($currentUserId, $friendId) {
                $query->where('sender_id', $friendId)
                    ->where('receiver_id', $currentUserId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.messages', ['messages' => $messages, 'friendId' => $friendId]);
    }

    public function sendMessage(Request $request, $friendId)
    {
        $message = new Message();
        $message->sender_id = auth()->id();
        $message->receiver_id = $friendId;
        $message->content = $request->input('content');
        $message->save();

        return redirect()->route('messages.show', ['friend_id' => $friendId]);
    }

}
