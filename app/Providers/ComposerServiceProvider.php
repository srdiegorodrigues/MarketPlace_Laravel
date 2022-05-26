<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //$categories = \App\Category::all(['name','slug']);

        //view()->share('categories',$categories); // compartilha com todas as views ao mesmo tempo
        /*view()->composer('*',function($view) use($categories){ //composer compõe views com informações que queremos compartilhar para elas

            $view->with('categories',$categories);

        });*/

        view()->composer('layouts.front','App\Http\Views\CategoryViewComposer@compose');
    }
}
