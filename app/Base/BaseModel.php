<?php

namespace App\Base;

use App\Exceptions\SystemException;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    /**
     * @var string
     */
    const TABLE_NAME = '';

    /**
     * BaseModel constructor.
     * @param array $attributes
     * @throws SystemException
     */
    public function __construct(array $attributes = [])
    {
        if (empty(trim(static::TABLE_NAME))) {
            server_exception('05540');
        }

        $this->setTable(static::TABLE_NAME);

        parent::__construct($attributes);
    }
}
