<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        try {
            if (!Auth::check()) {
                Log::info('CheckRole middleware: User not authenticated');
                return redirect()->route('login')->with('error', 'Veuillez vous connecter d\'abord.');
            }

            $user = Auth::user();
            Log::info('CheckRole middleware: Checking role for user ' . $user->id);
            Log::info('User role_id: ' . $user->role_id);
            Log::info('User role name: ' . optional($user->role)->nom);
            Log::info('Required role: ' . $role);

            if ($user->role_id === 1 || strtolower($user->role->nom) === strtolower($role)) {
                Log::info('CheckRole middleware: User has required role');
                return $next($request);
            }

            Log::info('CheckRole middleware: User does not have required role');
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les droits d\'accès nécessaires.');
        } catch (\Exception $e) {
            Log::error('CheckRole middleware error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }
}