<?php

namespace App\Providers;

use Intervention\Image\ImageManager;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
         $this->app->bind('image', function() {
        return new ImageManager(
            ['driver' => 'gd'] // বা 'imagick'
        );
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
