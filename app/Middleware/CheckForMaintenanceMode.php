<?php

namespace App\Middleware;

use App\Exceptions\SystemException;
use Closure;
use Symfony\Component\HttpFoundation\IpUtils;

class CheckForMaintenanceMode
{
    protected $except = [];

    protected $path;

    /**
     * CheckForMaintenanceMode constructor.
     */
    public function __construct()
    {
        $this->path = storage_path('framework/down');
    }

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws SystemException
     */
    public function handle($request, Closure $next)
    {
        if ($this->isDownForMaintenance()) {
            $data = json_decode(file_get_contents($this->path), true);

            if (isset($data['allowed']) && IpUtils::checkIp($request->ip(), $data['allowed'])) {
                return $next($request);
            }

            if ($this->inExceptArray($request)) {
                return $next($request);
            }

            server_exception('00503');
        }

        return $next($request);
    }


    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }

        return false;
    }

    protected function isDownForMaintenance()
    {
        return file_exists($this->path);
    }
}
