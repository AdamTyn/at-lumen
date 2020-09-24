<?php

/**
 * 核心辅助函数
 */

use App\Exceptions\SystemException;
use App\Structs\Base;

if (!function_exists('app_path')) {
    function app_path(string $path = '')
    {
        return base_path('app') . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('to_json')) {
    function to_json($data): string
    {
        $res = json_encode($data, JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE);

        if ($res === false) {
            $res = '';
        }

        return $res;
    }
}

if (!function_exists('codes')) {
    function codes(string $code)
    {
        $message = config('codes.' . $code);

        if ($message === null) {
            return $code;
        }

        return $message;
    }
}

if (!function_exists('output')) {
    function output(string $code, string $message = '', $data = null)
    {
        $res = new Base;

        $res->withCode($code)->withMessage($message)->withData($data);

        print_r($res->toJson());

        die;
    }
}

if (!function_exists('output_with_meta')) {
    function output_with_meta(string $code, string $message = '', $data = null, array $meta = [])
    {
        $res = new Base;

        $res->withCode($code)->withMessage($message)->withData($data)->withMeta($meta);

        print_r($res->toJson());

        die;
    }
}

if (!function_exists('success')) {
    function success($data = null, array $meta = [])
    {
        $code = '00200';

        count($meta) > 0 ? output_with_meta($code, '', $data, $meta)
            : output($code, '', $data);
    }
}

if (!function_exists('invalid')) {
    function invalid(string $message = '', $errors = null)
    {
        $code = '00400';

        output($code, $message, $errors);
    }
}

if (!function_exists('too_many_attempts')) {
    function too_many_attempts()
    {
        $code = '00429';

        output($code);
    }
}

if (!function_exists('debugger')) {
    function debugger($data)
    {
        if (config('app.env') !== 'production') {
            dd($data);
        }
    }
}

if (!function_exists('server_exception')) {
    /**
     * @param string $code
     * @param string $message
     * @throws SystemException
     */
    function server_exception(string $code, string $message = '')
    {
        throw new SystemException($code, $message);
    }
}
