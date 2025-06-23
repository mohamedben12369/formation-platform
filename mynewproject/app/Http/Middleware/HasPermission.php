<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HasPermission
{
    public function handle($request, Closure $next, $permission)
    {
        if (Auth::check() && Auth::user()->hasPermission($permission)) {
            return $next($request);
        }
        abort(403, 'Accès refusé');
    }
}
