<?php

$system = [
    '00200' => '成功',
    '00500' => '已下线',
    '00400' => '错误的请求体',
    '00401' => '未授权的请求',
    '00429' => '过高的访问频率',
    '05500' => 'Event类必须定义EVENT_NAME常量',
    '05510' => 'Form类必须定义FORM_NAME常量',
    '05511' => '不存在的Form类',
    '05520' => 'Listener类必须定义LISTENER_NAME常量',
    '05530' => 'Resource类必须定义RESOURCE_NAME常量',
];

$v1 = app_path('V1/codes.php');

$v1 = include $v1;

return ($system + $v1);
