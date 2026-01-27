<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        // Split roles by pipe character if multiple roles are provided
        $roles = explode('|', $role);
        
        if (!$user || !$user->hasAnyRole($roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
