<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RealPage\Builder\BuilderServiceProvider;

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
        if (config('app.debug')) {
            $this->app->register(BuilderServiceProvider::class);
        }
    }
}
