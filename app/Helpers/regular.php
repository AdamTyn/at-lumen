<?php

/**
 * 正则辅助函数
 */

if (!function_exists('cn_mobile')) {
    function cn_mobile($mobile)
    {
        $reg = '/^1[3456789]\d{9}$/ims';

        if (preg_match($reg, $mobile)) {
            return true;
        }

        return false;
    }
}
