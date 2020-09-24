<?php

namespace App\Base;

use App\Exceptions\SystemException;

abstract class BaseListener
{
    /**
     * BaseListener constructor.
     * @throws SystemException
     */
    public function __construct()
    {
        defined('static::LISTENER_NAME') ?: server_exception('05520');
    }

    abstract public function handle($event);
}
