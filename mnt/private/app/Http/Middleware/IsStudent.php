<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isStudent()) {
            if (auth()->user()->isSuperAdmin()) {
                return redirect()->route('superadmin.addcomp');
            }
            if (auth()->user()->isDirector()) {
                return redirect()->route('directeur');
            }
            if (auth()->user()->isManager()) {
                return redirect()->route('responsable-formation');
            }
            if (auth()->user()->isTeacher()) {
                return redirect()->route('initiateur');
            }
        }
        return $next($request);
    }
}