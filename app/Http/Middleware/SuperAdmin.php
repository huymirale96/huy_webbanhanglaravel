<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status == config('const.ACTIVE')) {
            if (Auth::user()->role == config('const.SUPER_ADMIN'))
                return $next($request);
            return redirect()->route('admin.home');
        }
        return redirect()->route('admin.get_login');
    }
}
