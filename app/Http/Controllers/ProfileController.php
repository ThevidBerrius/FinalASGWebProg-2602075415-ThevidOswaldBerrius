<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function show($id)
    {
        $user = User::findOrFail($id);

        $friends = User::whereHas('friend', function ($query) use ($user) {
            $query->where('user_id', $user->id)->orWhere('friend_id', $user->id);
        })->get();

        return view('pages.profile', compact('user', 'friends'));
    }

    public function removeFriend($friendId)
    {
        $currentUserId = auth()->id();

        Friend::where(function ($query) use ($currentUserId, $friendId) {
            $query->where('user_id', $currentUserId)
                  ->where('friend_id', $friendId);
        })->orWhere(function ($query) use ($currentUserId, $friendId) {
            $query->where('friend_id', $currentUserId)
                  ->where('user_id', $friendId);
        })->delete();

        return redirect()->back()->with('success', 'Friend Removed');
    }
}
