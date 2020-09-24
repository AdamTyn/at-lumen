<?php

namespace App\Middleware;

use App\Events\RouteEvent;
use Closure;

class Logger
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        event(new RouteEvent($request->route()));

        return $next($request);
    }
}
