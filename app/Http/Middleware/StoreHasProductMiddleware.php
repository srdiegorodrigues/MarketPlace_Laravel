<?php

namespace App\Http\Middleware;

use Closure;

class StoreHasProductMiddleware
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
        if($user->role == "ADMINISTRATOR"){
            return $next($request);
        }

        $userStore = $user->store->id;

        $productId = $request->route('product');
        $product = \App\Product::findOrFail($productId);

        if($product->store_id === $userStore) {
            return $next($request);
        }else{
            flash('Você não pode realizar essa operação!')->warning();
            return redirect()->route('manager.products.index');
        }

    }
}
