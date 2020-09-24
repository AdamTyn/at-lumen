<?php

namespace App\Listeners;

use App\Base\BaseListener;
use App\Events\RouteEvent;
use Illuminate\Support\Facades\Log;

class RouteListener extends BaseListener
{
    const LISTENER_NAME = 'RouteListener';

    /**
     * @param RouteEvent $event
     */
    public function handle($event)
    {
        Log::channel('router')->info(to_json($event->param));
    }
}
