<?php

namespace App\Http\Middleware;

use Closure;


class UserHasStoreMiddleware
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
        if(auth()->user()->store()->count()){
            flash('Você já possui uma loja!')->warning();
            return redirect()->route('manager.stores.index');
        }

        if(auth()->user()->role != 'ROLE_OWNER' and auth()->user()->role != 'ADMINISTRATOR' ){
            flash('Você não tem acesso a esta funcionalidade!')->warning();
            return redirect()->route('home');
        }
        return $next($request);
    }
}
