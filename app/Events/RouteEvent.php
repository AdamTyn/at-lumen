<?php

namespace App\Events;

use App\Base\BaseEvent;

final class RouteEvent extends BaseEvent
{
    const EVENT_NAME = 'RouteEvent';

    public $param;

    public function __construct($route)
    {
        parent::__construct();

        $this->param = $route[1] ?? null;
    }
}
