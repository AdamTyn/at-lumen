<?php

namespace App\Middleware;

use App\Exceptions\SystemException;
use Closure;

class Switcher
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws SystemException
     */
    public function handle($request, Closure $next)
    {
        $router = $request->route();

        if (config('switcher.' . $router[1]['uses']) === 'off') {
            server_exception('00500');
        }

        return $next($request);
    }
}
