<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{
    public function toggle_follow()
    {
        $user = User::findOrFail(request('user_id'));
        auth()->user()->toggle_follow($user);
        return back();
    }

    public function confirm(User $user)
    {
        auth()->user()->confirm_request($user);
        return back();
    }
}
