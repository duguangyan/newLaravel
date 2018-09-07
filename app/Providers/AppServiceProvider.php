<?php

namespace App\Providers;

use App\Topics;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //
        Schema::defaultStringLength(191);
        View()->composer('layout.nav', function($view){
            $user = \Auth::user();
            $view->with('user', $user);
        });

        View()->composer('layout.sidebar', function($view){
            $topics = Topics::all();
            $view->with('topics', $topics);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
