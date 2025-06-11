<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RequirePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip if user is not authenticated
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // Skip if user doesn't need to change password
        if (!$user->must_change_password) {
            return $next($request);
        }

        // Allow access to password change routes and logout
        $allowedRoutes = [
            'password.change',
            'password.change.post',
            'logout'
        ];

        // Also allow access by URL path for safety
        $allowedPaths = [
            '/change-password',
            '/logout'
        ];

        if (in_array($request->route()->getName(), $allowedRoutes) ||
            in_array($request->getPathInfo(), $allowedPaths)) {
            return $next($request);
        }

        // Redirect to password change page
        return redirect()->route('password.change');
    }
}
