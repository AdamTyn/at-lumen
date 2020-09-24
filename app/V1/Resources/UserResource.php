<?php

namespace App\V1\Resources;

use App\Base\BaseResource;

class UserResource extends BaseResource
{
    const RESOURCE_NAME = 'UserResource';

    public function toArray($request)
    {
        $append = [
            'caller' => 'UserResource'
        ];

        $data = parent::toArray($request);

        return $append + $data;
    }
}
