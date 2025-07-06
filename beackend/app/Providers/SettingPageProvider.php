<?php

namespace App\Providers;

use App\Services\SettingPageServices;
use Illuminate\Support\ServiceProvider;

class SettingPageProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
         $this->app->singleton(SettingPageServices::class,function(){
             return new SettingPageServices();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
