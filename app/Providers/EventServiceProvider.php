<?php

namespace App\Providers;

use App\Events\RouteEvent;
use App\Listeners\RouteListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RouteEvent::class => [
            RouteListener::class
        ],
    ];
}
