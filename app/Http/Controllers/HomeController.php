<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentUserId = auth()->id();
        $users = User::where('id', '!=', $currentUserId)->get();
        $notifications = Notification::where('user_id', $currentUserId)->get();

        return view('home', compact('users', 'notifications'));
    }


    public function sendFriendRequest($friendId)
    {
        // Simpan ke tabel friends
        $friend = new Friend();
        $friend->user_id = auth()->id();
        $friend->friend_id = $friendId;
        $friend->sender_id = auth()->id();
        $friend->status = 'pending';
        $friend->save();

        // Simpan notifikasi ke tabel notifications
        $notification = new Notification();
        $notification->user_id = $friendId; // User yang menerima permintaan
        $notification->sender_id = auth()->id(); // User yang mengirim permintaan
        $notification->content = 'You have a new friend request.';
        $notification->type = 'request';
        $notification->save();

        return redirect()->route('home')->with('success', 'Friend request sent successfully.');
    }

    public function acceptFriendRequest($friendId)
    {
        $friend = Friend::where('user_id', auth()->id())
            ->where('friend_id', $friendId)
            ->where('status', 'pending')
            ->first();

        if ($friend) {
            $friend->status = 'accepted';
            $friend->save();

        }

        return redirect()->back()->with('success', 'Friend request accepted.');
    }

    public function declineFriendRequest($friendId)
    {
        $friend = Friend::where('user_id', auth()->id())
            ->where('friend_id', $friendId)
            ->where('status', 'pending')
            ->first();

        if ($friend) {
            $friend->delete();

        }

        return redirect()->back()->with('success', 'Friend request declined.');
    }

}
