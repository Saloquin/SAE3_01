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
        if (!session()->has('student')) {
            if (session()->has('superadmin')) {
                return redirect()->route('superadmin.addcomp');
            }
            if (session()->has('director')) {
                return redirect()->route('directeur');
            }
            if (session()->has('manager')) {
                return redirect()->route('responsable');
            }
            if (session()->has('teacher')) {
                return redirect()->route('initiateur');
            }
        }
        return $next($request);
    }
    
}