<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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

        // Check if user must change password
        if ($user->must_change_password) {
            return redirect()->route('password.change');
        }

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
        // Log the logout attempt
        \Log::info('User logout attempt', [
            'user_id' => Auth::id(),
            'user_role' => Auth::user() ? Auth::user()->role : 'unknown',
            'session_id' => session()->getId()
        ]);
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'You have been successfully logged out.');
    }

    public function showChangePasswordForm()
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Log access to change password form
        \Log::info('User accessing change password form', [
            'user_id' => Auth::id(),
            'user_role' => Auth::user()->role,
            'session_id' => session()->getId()
        ]);

        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Debug logging
        \Log::info('Password change attempt', [
            'user_id' => $user->id,
            'user_role' => $user->role,
            'must_change_password' => $user->must_change_password,
            'session_id' => session()->getId(),
            'csrf_token_present' => $request->has('_token')
        ]);

        // Handle potential CSRF token issues
        try {
            $request->validate([
                'current_password' => ['required'],
                'new_password' => [
                    'required',
                    'confirmed',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                ],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Password change validation failed', [
                'user_id' => $user->id,
                'errors' => $e->errors()
            ]);
            throw $e;
        } catch (\Illuminate\Session\TokenMismatchException $e) {
            \Log::error('CSRF token mismatch in password change', [
                'user_id' => $user->id,
                'session_id' => session()->getId()
            ]);
            return back()->withErrors([
                'csrf' => 'Your session has expired. Please try again.'
            ])->withInput($request->except(['current_password', 'new_password', 'new_password_confirmation']));
        }

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        // Update password and tracking fields
        $user->update([
            'password' => Hash::make($request->new_password),
            'must_change_password' => false,
            'password_changed_at' => now(),
        ]);

        // Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully!');
        } else if ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard')->with('success', 'Password changed successfully!');
        } else if ($user->role === 'student') {
            return redirect()->route('student.dashboard')->with('success', 'Password changed successfully!');
        }

        return redirect()->intended('/')->with('success', 'Password changed successfully!');
    }
}
