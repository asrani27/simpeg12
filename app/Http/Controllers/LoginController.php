<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect(roleUser(Auth::user()));
        }
        return view('login');
    }

    public function login(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ], $request->boolean('remember'))) {

            // Regenerate the session to prevent session fixation
            $request->session()->regenerate();

            // Get the authenticated user
            $user = Auth::user();

            // Check if 2FA is enabled
            if ($user->google2fa_enabled) {
                // Redirect to 2FA verification
                return redirect()->route('2fa.verify');
            }

            // Redirect based on user role
            return redirect()->intended(roleUser($user));
        }

        // Authentication failed
        return back()
            ->withInput($request->only('username', 'remember'))
            ->withErrors([
                'username' => 'Username atau password salah.',
            ]);
    }
}
