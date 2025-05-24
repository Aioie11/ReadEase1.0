<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'userId' => ['required'],
            'password' => ['required'],
        ]);

        // Find user by userId
        $user = \App\Models\User::where('userId', $credentials['userId'])->first();

        if (!$user) {
            return back()->withErrors([
                'userId' => 'The provided user ID does not exist.',
            ])->onlyInput('userId');
        }

        if (!\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'The provided password is incorrect.',
            ])->onlyInput('userId');
        }

        Auth::login($user);
        $request->session()->regenerate();
        
        // Set session data
        session(['user_id' => $user->id]);
        session(['user_role' => $user->role]);
        
        // Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else if ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        } else if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }
        
        // Default redirect if role is not specified
        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
