<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate and update user profile data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Add other validation rules as needed
        ]);

        $user->update($request->only('name', 'email')); // Update the user data

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
