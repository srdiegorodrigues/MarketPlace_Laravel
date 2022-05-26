<?php

namespace App\Http\Middleware;

use Closure;


class AccessControlManager
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
        if(auth()->user()->role != 'ADMINISTRATOR' and auth()->user()->role != 'ROLE_OWNER')
            return redirect()->route('user.orders');
        return $next($request);
    }
}
