<?php

namespace App\Providers;

use App\Repositories\AreaRepo;
use App\Repositories\Interface\AreaRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\UserRepo;
use Illuminate\Support\ServiceProvider;
use app\Service\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
       $this->app->bind(UserRepositoryInterface::class, UserRepo::class);
       $this->app->bind(AreaRepositoryInterface::class, AreaRepo::class);
       $this->app->bind(UserService::class, UserRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
