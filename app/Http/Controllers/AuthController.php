<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle the incoming login request.
     */
    public function login(Request $request)
    {
        // Validate the user input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if the user selected the "Remember Me" checkbox
        $remember = $request->boolean('remember');

        // Attempt to authenticate the user with the provided credentials
        if (Auth::attempt($credentials, $remember)) {
            // Regenerate the session to protect against session fixation attacks
            $request->session()->regenerate();

            // Redirect the user to the home page or intended URL
            return redirect()->intended('/');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle the incoming registration request.
     */
    public function register(Request $request)
    {
        // Validate the user input without phone and user_type
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted'],
        ]);

        $fullName = $validatedData['first_name'] . ' ' . $validatedData['last_name'];

        // Create the new user record in the database
        $user = User::create([
            'name' => $fullName,
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Log the newly registered user into the application
        Auth::login($user);

        // Redirect the user to the home page after successful registration
        return redirect('/');
    }

    /**
     * Handle the logout request.
     */
    public function logout(Request $request)
    {
        // Log the user out of the application
        Auth::logout();

        // Invalidate the user's current session
        $request->session()->invalidate();

        // Regenerate the CSRF token for security
        $request->session()->regenerateToken();

        // Redirect the user back to the home page
        return redirect('/');
    }
}
