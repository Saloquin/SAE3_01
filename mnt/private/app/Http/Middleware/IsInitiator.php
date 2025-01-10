<?php

namespace App\Http\Middleware;

use Closure;

class IsInitiator
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
        if (!session()->has('teacher')) {
            if (session()->has('superadmin')) {
                return redirect()->route('superadmin.addcomp');
            }
            if (session()->has('director')) {
                return redirect()->route('directeur');
            }
            if (session()->has('manager')) {
                return redirect()->route('responsable-formation');
            }
            if (session()->has('student')) {
                return redirect()->route('eleve');
            }
        }
        return $next($request);
    }
}