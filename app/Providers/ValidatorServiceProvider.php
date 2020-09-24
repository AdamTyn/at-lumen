<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

final class ValidatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('cn_mobile', function ($attribute, $value, $parameters, $validator) {
            return cn_mobile($value);
        });
    }
}
