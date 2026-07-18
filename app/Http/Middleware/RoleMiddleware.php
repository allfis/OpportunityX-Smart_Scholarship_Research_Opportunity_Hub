<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Check if the authenticated user has the required role(s).
     * Usage in route: ->middleware('role:admin') or ->middleware('role:student,faculty')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // If user is not logged in, redirect to login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // If user account is deactivated
        if (!$request->user()->is_active) {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'Your account has been deactivated. Contact admin.');
        }

        // Check if user's role matches any of the allowed roles
        if (!in_array($request->user()->role, $roles)) {
            // Redirect to their own dashboard based on role
            $dashboardRoute = match($request->user()->role) {
                'admin' => 'admin.dashboard',
                'faculty' => 'faculty.dashboard',
                default => 'student.dashboard',
            };

            return redirect()->route($dashboardRoute)
                ->with('error', 'You do not have permission to access that page.');
        }

        return $next($request);
    }
}