<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;

class CustomerMiddleware
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
            || !in_array($request->user()->role, [UserRole::Customer, UserRole::Employee, UserRole::Manager, UserRole::Director, UserRole::Admin], true))
            abort(401);

        return $next($request);
    }
}
