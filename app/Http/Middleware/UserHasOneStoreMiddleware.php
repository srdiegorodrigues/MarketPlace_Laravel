<?php

namespace App\Http\Middleware;

use Closure;


class UserHasOneStoreMiddleware
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
        $user = auth()->user();
        if($user->role == 'ROLE_OWNER'){
            $userStore = $user->store->id;
            $storeId = $request->route('store');
            if($userStore == $storeId){
                return $next($request);
            }
        }
        if($user->role == "ADMINISTRATOR"){
            return $next($request);
        }else{
            flash('Você não pode realizar essa operação!')->warning();
            return redirect()->route('manager.stores.index');
        }
    }
}
