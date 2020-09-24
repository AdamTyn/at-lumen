<?php

namespace App\Base;

use App\Exceptions\SystemException;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
    /**
     * BaseResource constructor.
     * @param $resource
     * @throws SystemException
     */
    public function __construct($resource)
    {
        defined('static::RESOURCE_NAME') ?: server_exception('05530');

        parent::__construct($resource);
    }
}
