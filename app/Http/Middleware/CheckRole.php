<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is logged in
        if (!$request->user()) {
            return redirect('login');
        }
        
        // If no specific roles are required or user is admin, proceed
        if (empty($roles) || $request->user()->isAdmin()) {
            return $next($request);
        }
        
        // Check if the user has any of the required roles
        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                return $next($request);
            }
        }
        
        // If the user doesn't have any of the required roles
        return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}