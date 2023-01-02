<?php

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
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
            foreach (Configuration::all() as $setting) {
                if($setting->value == "true" || $setting->value == "false")
                {
                    Config::set('app.'.$setting->name, ($setting->value) == "true" );
                    continue;
                }
                Config::set('app.'.$setting->name, $setting->value);
            }
        Paginator::useBootstrapFive();
    }
}
