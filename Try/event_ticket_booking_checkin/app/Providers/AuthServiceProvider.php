<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Checkin;
use App\Models\Event;
use App\Models\Ticket;
use App\Policies\Booking\BookingPolicy;
use App\Policies\Checkin\CheckinPolicy;
use App\Policies\Event\EventPolicy;
use App\Policies\Ticket\TicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ProvidersAuthServiceProvider;

class AuthServiceProvider extends ProvidersAuthServiceProvider
{
    protected $policies = [
        Booking::class => BookingPolicy::class,
        Ticket::class => TicketPolicy::class,
        Event::class => EventPolicy::class,
        Checkin::class => CheckinPolicy::class
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
