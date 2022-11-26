<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Paginator;
use Illuminate\Pagination\Paginator;

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
        //Paginator::useBootstrapFour();
        //Paginator::useBootstrapFive();
        Paginator::useBootstrap();
    }
}
