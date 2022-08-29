<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(User $user)
    {
        return view('user.profile', compact('user'));
    }

    public function edit(User $user)
    {

        $this->authorize('view', $user);
        return view("user.edit", compact('user'));
    }

    public function store(User $user, UpdateUserProfileRequest $request)
    {
        $data = $request->toArray();
        if ($request->has('password')) {
            $data['password'] = Hash::make($request['password']);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('users');
            $data['image'] = '/' . $path;
        }

        $user->update($data);
        return redirect()->route('user_profile', $user);
    }
}
