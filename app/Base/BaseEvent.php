<?php

namespace App\Base;

use App\Exceptions\SystemException;
use Illuminate\Queue\SerializesModels;

abstract class BaseEvent
{
    use SerializesModels;

    /**
     * BaseEvent constructor.
     * @throws SystemException
     */
    public function __construct()
    {
        defined('static::EVENT_NAME') ?: server_exception('05500');
    }
}
