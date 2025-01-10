<?php

namespace App\Http\Middleware;

use Closure;

class IsDirector
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
        if (!session()->has('director')) {
            if (session()->has('superadmin')) {
                return redirect()->route('superadmin.addcomp');
            }
            if (session()->has('manager')) {
                return redirect()->route('responsable');
            }
            if (session()->has('teacher')) {
                return redirect()->route('initiateur');
            }
            if (session()->has('student')) {
                return redirect()->route('eleve');
            }
            return redirect()->route('connexion');
        }

        return $next($request);
    }
}
