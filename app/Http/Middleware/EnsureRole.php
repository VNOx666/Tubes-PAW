<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        if (!$user) abort(401);

        // Sesuaikan field role kamu: role, user_type, is_seller, dsb.
        $userRole = $user->role ?? null;

        if (!$userRole || (!empty($roles) && !in_array($userRole, $roles, true))) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
