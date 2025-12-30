<?php

namespace App\Providers;

use App\Models\Event;
use App\Policies\Event\EventPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ProvidersAuthServiceProvider;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ProvidersAuthServiceProvider
{
    protected $policies = [
        Event::class => EventPolicy::class
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
