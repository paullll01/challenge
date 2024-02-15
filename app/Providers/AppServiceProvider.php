<?php

namespace App\Providers;

use App\Services\Ticket\TicketService;
use App\Services\Ticket\ITicketService;
use Illuminate\Support\ServiceProvider;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
