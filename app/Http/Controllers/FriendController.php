<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function friends()
{
    $currentUserId = auth()->id();

    $friends = Friend::where(function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId)
                ->orWhere('friend_id', $currentUserId);
        })
        ->where('status', 'accepted')
        ->with(['user', 'friend'])
        ->get();

    $friendsList = $friends->map(function ($friend) use ($currentUserId) {
        return $friend->user_id === $currentUserId ? $friend->friend : $friend->user;
    });

    return view('pages.friends', ['friends' => $friendsList]);
}
}
