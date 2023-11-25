<?php

namespace App\Providers;

use App\Actions\Fortify\SaveProfileAction;
use App\Contracts\SaveProfile;
use App\Models\Configuration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SaveProfile::class,SaveProfileAction::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(Schema::hasTable('config')) {
            foreach (Configuration::all() as $setting) {
                if ($setting->value == "true" || $setting->value == "false") {
                    Config::set('app.' . $setting->name, ($setting->value) == "true");
                    continue;
                }
                Config::set('app.' . $setting->name, $setting->value);
            }
            Config::set('app.is-stable',true);
        }
        else
        {
            Config::set('app.is-stable',false);
        }
        Paginator::useTailwind();
    }
}
