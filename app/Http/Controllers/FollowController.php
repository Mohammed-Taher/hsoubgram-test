<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggle()
    {
       $user = User::findOrFail(request('user_id'));
       auth()->user()->toggle($user);
       return back();
    }
}
