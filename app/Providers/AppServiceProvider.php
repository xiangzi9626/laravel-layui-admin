<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(190);
        //视图合成器，页面调用的时候注入专题类容
        \View::composer('layout.left',function ($view){
            $topic = \App\Topic::all();
            $view->with('topic',$topic);
        });
        //
    }
}
