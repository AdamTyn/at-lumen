<?php

namespace App\Base;

use App\Exceptions\SystemException;
use Illuminate\Http\Request;

abstract class BaseForm
{
    /**
     * BaseForm constructor.
     * @throws SystemException
     */
    public function __construct()
    {
        defined('static::FORM_NAME') ?: server_exception('05510');
    }

    abstract public function handle(Request $request);
}
