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

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect based on user role
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->role === 'teacher') {
                return redirect()->route('teacher.dashboard');
            } else if (Auth::user()->role === 'student') {
                return redirect()->route('student.dashboard');
            }
            
            // Default redirect if role is not specified
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'userId' => 'The provided credentials do not match our records.',
        ])->onlyInput('userId');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
