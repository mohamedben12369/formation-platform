<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IsAdmin
{


public function handle(Request $request, Closure $next)
{
    // Add debugging
    Log::info('Checking admin access for user: ' . (Auth::user() ? Auth::user()->id : 'null'));
    Log::info('User role_id: ' . (Auth::user() ? Auth::user()->role_id : 'null'));
    
    $user = Auth::user();
    if (Auth::check() && $user && (
        ($user->role_id == 1) ||
        (strtolower(optional($user->role)->nom) === 'admin')
    )) {
        return $next($request);
    }
    
    // Add debugging
    Log::info('Access denied - User is not admin');
    
    abort(403, 'Accès refusé');
}}