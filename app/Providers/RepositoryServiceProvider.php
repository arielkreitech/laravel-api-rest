<?php

namespace App\Providers;

use App\Repositories\Contracts\{
   UserRepositoryInterface,
   FactoryRepositoryInterface
};
use App\Repositories\Eloquent\{
    EloquentUserRepository,
};
use App\Repositories\FactoryRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }
}
