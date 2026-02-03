<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If user has 2FA enabled but hasn't verified it yet
        if ($user && $user->google2fa_enabled && !session('2fa_verified')) {
            // Allow access to 2FA verification page and logout
            if ($request->routeIs('2fa.verify') || $request->routeIs('logout')) {
                return $next($request);
            }

            // Redirect to 2FA verification
            return redirect()->route('2fa.verify');
        }

        return $next($request);
    }
}