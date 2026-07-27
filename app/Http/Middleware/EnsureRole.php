<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->status !== 'active') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->withErrors(['email' => 'Your account is inactive.']);
        }

        if (!in_array($user->role, $roles)) {
            // Redirect to appropriate dashboard if attempting unauthorized area
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('warning', 'Access restricted to staff only.');
            }
            if ($user->isStaff()) {
                return redirect()->route('staff.dashboard')->with('warning', 'Access restricted to administrators.');
            }
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
