<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

   public function register(Request $request)
{
    $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role'     => 'required|in:admin,anggotabase',
        'identitas' => 'required|string|max:50',
        'program_studi' => 'required|string|max:100',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle upload foto jika ada
    $photoPath = null;
    if ($request->hasFile('profile_photo')) {
        $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
    }

    User::create([
        'name'     => $validated['name'],
        'email'    => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role'     => $validated['role'],
        'identitas' => $validated['identitas'],
        'program_studi' => $validated['program_studi'],
        'profile_photo' => $photoPath,
    ]);

    return redirect('/login')->with('success', 'Registration successful, please login.');
}

}
