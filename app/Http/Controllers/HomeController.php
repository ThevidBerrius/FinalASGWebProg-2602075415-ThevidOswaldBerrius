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

        $users = User::where('id', '!=', $currentUserId)
        ->whereDoesntHave('friendsAsUser', function ($query) use ($currentUserId) {
            $query->where('friend_id', $currentUserId)
                  ->where('status', 'accepted')
                  ->orWhere('status', 'pending');
        })
        ->whereDoesntHave('friendOf', function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId)
                  ->where('status', 'accepted')
                  ->orWhere('status', 'pending');
        })
        ->get();

        $notifications = Notification::where('user_id', $currentUserId)->get();

        $usersWithFriendRequestStatus = $users->map(function ($user) use ($currentUserId) {
            $user->friendRequestExists = Friend::where(function ($query) use ($currentUserId, $user) {
                $query->where('user_id', $currentUserId)
                    ->where('friend_id', $user->id)
                    ->where('status', 'pending');
            })->orWhere(function ($query) use ($currentUserId, $user) {
                $query->where('friend_id', $currentUserId)
                    ->where('user_id', $user->id)
                    ->where('status', 'pending');
            })->exists();

            return $user;
        });

        return view('pages.home', [
            'usersWithFriendRequestStatus' => $usersWithFriendRequestStatus,
            'notifications' => $notifications
        ]);
    }



    public function sendFriendRequest($friendId)
    {
        $friend = new Friend();
        $friend->user_id = auth()->id();
        $friend->friend_id = $friendId;
        $friend->sender_id = auth()->id();
        $friend->status = 'pending';
        $friend->save();

        $notification = new Notification();
        $notification->user_id = $friendId;
        $notification->sender_id = auth()->id();
        $notification->content = 'You have a new friend request.';
        $notification->type = 'request';
        $notification->save();

        return redirect()->route('home')->with('success', 'Friend request sent successfully.');
    }

}
