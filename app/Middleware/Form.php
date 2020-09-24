<?php

namespace App\Middleware;

use App\Base\BaseForm;
use App\Exceptions\SystemException;
use Closure;

class Form
{
    /**
     * @param $request
     * @param Closure $next
     * @param mixed $f
     * @return mixed
     * @throws SystemException
     */
    public function handle($request, Closure $next, $f)
    {
        $class = app($f);

        if ($class instanceof BaseForm) {
            $class->handle($request);
        } else {
            server_exception('05511');
        }

        return $next($request);
    }
}
