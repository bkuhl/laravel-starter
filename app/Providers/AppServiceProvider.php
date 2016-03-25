<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (class_exists('RealPage\Builder\BuilderServiceProvider')) {
            $this->app->register(\RealPage\Builder\BuilderServiceProvider::class);
        }
    }
}
