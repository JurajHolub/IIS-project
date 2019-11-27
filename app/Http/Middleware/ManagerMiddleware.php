<?php

namespace App\Http\Middleware;

use Closure;
use \App\Enums\UserRole;

class ManagerMiddleware
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
        if (!$request->user()
            || !in_array($request->user()->role, [UserRole::Manager, UserRole::Director, UserRole::Admin], true))
            return redirect('/home');

        return $next($request);
    }
}
