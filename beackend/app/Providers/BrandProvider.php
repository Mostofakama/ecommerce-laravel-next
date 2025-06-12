<?php

namespace App\Providers;

use App\Services\BrandServices;
use Illuminate\Support\ServiceProvider;

class BrandProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BrandServices::class,function(){
             return new BrandServices();
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
