<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdminEmail
{
    public function handle(Request $request, Closure $next)
    {
        $adminEmail = env('ADMIN_EMAIL');
        $user = $request->user();

        if (!$user || !$adminEmail || $user->email !== $adminEmail) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
