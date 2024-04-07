<?php

namespace App\Providers;

use App\Repositories\SeatTypeRepo;
use App\Repositories\SeatRepo;
use App\Repositories\CategoryRepo;
use App\Repositories\ComboRepo;
use App\Repositories\ConsumeRepo;
use App\Repositories\MovieRepo;
use App\Repositories\RoomRepo;
use App\Repositories\ShowtimeRepo;
use App\Repositories\TransactionRepo;
use App\Repositories\ReservationRepo;

use App\Repositories\Interface\SeatTypeRepositoryInterface;
use App\Repositories\Interface\SeatRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\ComboRepositoryInterface;
use App\Repositories\Interface\ConsumeRepositoryInterface;
use App\Repositories\Interface\MovieRepositoryInterface;
use App\Repositories\Interface\RoomRepositoryInterface;
use App\Repositories\Interface\ShowtimeRepositoryInterface;
use App\Repositories\Interface\TransactionRepositoryInterface;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;
use App\Repositories\Interface\VoucherRepositoryInterface;
use App\Repositories\RoleRepo;
use App\Repositories\UserRepo;
use App\Repositories\VoucherRepo;
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
       $this->app->bind(SeatRepositoryInterface::class, SeatRepo::class);
       $this->app->bind(SeatTypeRepositoryInterface::class, SeatTypeRepo::class);
       $this->app->bind(CategoryRepositoryInterface::class, CategoryRepo::class);
       $this->app->bind(ComboRepositoryInterface::class, ComboRepo::class);
       $this->app->bind(ConsumeRepositoryInterface::class, ConsumeRepo::class);
       $this->app->bind(MovieRepositoryInterface::class, MovieRepo::class);
       $this->app->bind(ConsumeRepositoryInterface::class, ConsumeRepo::class);
       $this->app->bind(RoleRepositoryInterface::class, RoleRepo::class);
       $this->app->bind(RoomRepositoryInterface::class, RoomRepo::class);
       $this->app->bind(ShowtimeRepositoryInterface::class, ShowtimeRepo::class);
       $this->app->bind(TransactionRepositoryInterface::class, TransactionRepo::class);
       $this->app->bind(ReservationRepositoryInterface::class, ReservationRepo::class);
       $this->app->bind(VoucherRepositoryInterface::class, VoucherRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
