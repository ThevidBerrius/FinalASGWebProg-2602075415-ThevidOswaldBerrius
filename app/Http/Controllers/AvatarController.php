<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    //

    public function index()
    {
        $avatars = Avatar::where('price', '>', 0)->get();
        return view('pages.avatar', compact('avatars'));
    }

    /**
     * Handle avatar selection and payment.
     */
    public function select(Request $request)
    {
        $avatar = Avatar::find($request->avatar_id);
        $user = auth()->user();

        if ($avatar && $avatar->price > 0) {
            if ($user->coins >= $avatar->price) {
                $user->coins -= $avatar->price;
                $user->save();

                $user->avatarTransactions()->create([
                    'avatar_id' => $avatar->id,
                    'price' => $avatar->price,
                ]);

                $user->avatar_id = $avatar->id;
                $user->save();

                return redirect()->back()->with('success', __('Avatar purchased successfully!'));
            } else {
                return redirect()->back()->with('error', __('Not enough coins to purchase this avatar.'));
            }
        }

        return redirect()->back()->with('error', __('Invalid avatar selection.'));
    }
}
