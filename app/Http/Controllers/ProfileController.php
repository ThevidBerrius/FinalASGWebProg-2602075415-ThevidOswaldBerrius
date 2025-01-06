<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function show()
    {
        $user = auth()->user()->load('occupation');
        $friends = $user->friends()->with('friend.occupation')->get();

        // Jika teman bisa juga berteman balik
        $friends = $friends->merge($user->friendOf()->with('user.occupation')->get());

        $purchasedAvatars = $user->avatarTransactions()->with('avatar')->get()->pluck('avatar');

        return view('pages.profile', compact('user', 'friends', 'purchasedAvatars'));
    }

    public function updateAvatar(Request $request)
    {
        $user = auth()->user();
        $avatar = Avatar::find($request->avatar_id);

        if ($avatar && $user->avatarTransactions()->where('avatar_id', $avatar->id)->exists()) {
            $user->avatar_id = $avatar->id;
            $user->save();

            return redirect()->back()->with('success', __('Avatar updated successfully!'));
        }

        return redirect()->back()->with('error', __('Invalid avatar selection.'));
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
