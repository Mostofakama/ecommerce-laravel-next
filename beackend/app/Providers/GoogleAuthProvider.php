<?php

namespace App\Providers;
use App\Services\GoogleAuthServices;
use Illuminate\Support\ServiceProvider;

class GoogleAuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->singleton(GoogleAuthServices::class,function(){
           return new GoogleAuthServices();
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
