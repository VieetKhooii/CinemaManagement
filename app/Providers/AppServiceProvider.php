<?php

namespace App\Providers;

use App\Repositories\AreaRepo;
use App\Repositories\BranchRepo;
use App\Repositories\CategoryRepo;
use App\Repositories\ComboRepo;
use App\Repositories\MovieRepo;

use App\Repositories\Interface\AreaRepositoryInterface;
use App\Repositories\Interface\BranchRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\ComboRepositoryInterface;
use App\Repositories\Interface\MovieRepositoryInterface;
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
       $this->app->bind(BranchRepositoryInterface::class, BranchRepo::class);
       $this->app->bind(AreaRepositoryInterface::class, AreaRepo::class);
       $this->app->bind(CategoryRepositoryInterface::class, CategoryRepo::class);
       $this->app->bind(ComboRepositoryInterface::class, ComboRepo::class);
       $this->app->bind(MovieRepositoryInterface::class, MovieRepo::class);
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
