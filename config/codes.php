<?php

/**
 * 0, 00 开始的为系统预留状态码, 业务状态码不可覆盖
 */

$system = [
    '00200' => '成功',
    '00400' => '错误的请求体',
    '00401' => '未授权的请求',
    '00429' => '过高的访问频率',
    '00500' => '已下线',
    '00503' => '已关闭',
    '05500' => 'Event类必须定义EVENT_NAME常量',
    '05510' => 'Form类必须定义FORM_NAME常量',
    '05511' => '不存在的Form类',
    '05520' => 'Listener类必须定义LISTENER_NAME常量',
    '05530' => 'Resource类必须定义RESOURCE_NAME常量',
    '05540' => 'Model类必须定义TABLE_NAME常量',
];

$v1 = app_path('V1/codes.php');

$v1 = include $v1;

return ($system + $v1);
