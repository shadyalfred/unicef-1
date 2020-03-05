<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.profile')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [];

        if ($request->name !== $user->name) {
            $rules['name'] = 'required|max:255';
        }

        if ($request->email !== $user->email) {
            $rules['email'] = 'required|email|unique:users,email';
        }

        if ($request->password) {
            $rules['password'] = 'required|min:8|confirmed';
        }

        if ($request->hasFile('profile_picture')) {
            $rules['profile_picture'] = 'file|max:1000';
        }

        $validatedData = $request->validate($rules);
        
        if (array_key_exists('name', $validatedData)) {
            $user->name = $validatedData['name'];
        }

        if (array_key_exists('email', $validatedData)) {
            $user->email_verified_at = null;
            $user->email = $validatedData['email'];
        }

        if (array_key_exists('password', $validatedData)) {
            $user->password = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture !== 'profile_pictures/default.png') {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        if (is_null($user->email_verified_at)) {
            $user->sendEmailVerificationNotification();
        }
        
        if (!empty($validatedData)) {
            return back()->withSuccess(__('User was updated successfully!'));
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
