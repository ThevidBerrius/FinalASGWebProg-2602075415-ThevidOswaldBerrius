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
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $message = new Message();
        $message->sender_id = auth()->id();
        $message->receiver_id = $friendId;
        $message->content = $request->input('content');
        $message->save();

        return redirect()->route('messages.show', ['friendId' => $friendId])->with('success', 'Message sent successfully!');
    }

}
