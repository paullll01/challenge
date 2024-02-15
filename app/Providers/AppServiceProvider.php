<?php

namespace App\Providers;

use App\Services\User\UserService;
use App\Services\User\IUserService;
use App\Services\Ticket\TicketService;
use App\Services\Ticket\ITicketService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\Ticket\TicketRepository;
use App\Repositories\Ticket\ITicketRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ITicketRepository::class,TicketRepository::class);
        $this->app->bind(ITicketService::class,TicketService::class);
        $this->app->bind(IUserService::class,UserService::class);
        $this->app->bind(IUserRepository::class,UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
