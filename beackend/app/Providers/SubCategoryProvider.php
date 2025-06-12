<?php

namespace App\Providers;

use App\Services\SubCategoryServices;
use Illuminate\Support\ServiceProvider;

class SubCategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SubCategoryServices::class,function(){
             return new SubCategoryServices();
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
