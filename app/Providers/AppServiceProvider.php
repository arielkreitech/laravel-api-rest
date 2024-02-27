<?php

namespace App\Providers;

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
        $this->app->bind('App\Services\Contracts\UserServiceInterface', 'App\Services\Models\UserService');
        $this->app->bind('App\Repositories\Contracts\FactoryRepositoryInterface','App\Repositories\FactoryRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
