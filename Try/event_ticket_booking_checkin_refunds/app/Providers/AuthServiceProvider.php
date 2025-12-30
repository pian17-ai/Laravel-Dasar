<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Ticket;
use App\Policies\Event\EventPolicy;
use App\Policies\Ticket\TicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ProvidersAuthServiceProvider;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ProvidersAuthServiceProvider
{
    protected $policies = [
        Event::class => EventPolicy::class,
        Ticket::class => TicketPolicy::class
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
