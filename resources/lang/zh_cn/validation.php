<?php

/**
 * @author AdamTyn
 * @description 验证信息-中文
 */
return [
    'accepted' => ':attribute必须接受.',
    'active_url' => ':attribute不是一个有效的网址.',
    'after' => ':attribute必须是一个在 :date 之后的日期.',
    'after_or_equal' => ':attribute必须是一个等于:date或在 :date 之后的日期.',
    'alpha' => ':attribute只能由字母组成.',
    'alpha_dash' => ':attribute只能由字母、数字和斜杠组成.',
    'alpha_num' => ':attribute只能由字母和数字组成.',
    'array' => ':attribute必须是一个数组.',
    'before' => ':attribute必须是一个在 :date 之前的日期.',
    'before_or_equal' => ':attribute必须是一个等于:date或在 :date 之前的日期.',
    'between' => [
        'numeric' => ':attribute必须介于 :min - :max 之间.',
        'file' => ':attribute必须介于 :min - :max kb 之间.',
        'string' => ':attribute必须介于 :min - :max 个字符之间.',
        'array' => ':attribute必须只有 :min - :max 个单元.',
    ],
    'boolean' => ':attribute必须为布尔值.',
    'confirmed' => ':attribute两次输入不一致.',
    'date' => ':attribute不是一个有效的日期.',
    'date_format' => ':attribute的格式必须为 :format.',
    'different' => ':attribute和 :other 必须不同.',
    'digits' => ':attribute必须是 :digits 位的数字.',
    'digits_between' => ':attribute必须是介于 :min 和 :max 位的数字.',
    'distinct' => ':attribute已經存在.',
    'email' => ':attribute不是一个合法的邮箱.',
    'exists' => ':attribute不存在.',
    'file' => ':attribute不能为空.',
    'filled' => ':attribute不能为空.',
    'image' => ':attribute必须是图片.',
    'in' => '已选的属性:attribute非法.',
    'in_array' => ':attribute没有在 :other 中.',
    'integer' => ':attribute必须是整数.',
    'ip' => ':attribute必须是有效的 IP 地址.',
    'ipv4' => ':attribute必须是有效的 IPv4  地址.',
    'ipv6' => ':attribute必须是有效的 IPv6 地址.',
    'json' => ':attribute必须是正确的 JSON 格式.',
    'max' => [
        'numeric' => ':attribute不能大于 :max.',
        'file' => ':attribute不能大于 :max kb.',
        'string' => ':attribute不能大于 :max 个字符.',
        'array' => ':attribute最多只有 :max 个单元.',
    ],
    'mimes' => ':attribute必须是一个 :values 类型的文件.',
    'mimetypes' => ':attribute必须是一个 :values 类型的文件.',
    'min' => [
        'numeric' => ':attribute必须大于等于 :min.',
        'file' => ':attribute大小不能小于 :min kb.',
        'string' => ':attribute至少为 :min 个字符.',
        'array' => ':attribute至少有 :min 个单元.',
    ],
    'not_in' => '已选的属性 :attribute非法.',
    'numeric' => ':attribute必须是一个数字.',
    'present' => ':attribute必须存在.',
    'regex' => ':attribute格式不正确.',
    'required' => ':attribute不能为空.',
    'required_if' => '当 :other 为 :value 时:attribute不能为空.',
    'required_unless' => '当 :other 不为 :value 时:attribute不能为空.',
    'required_with' => '当 :values 存在时 :attribute不能为空.',
    'required_with_all' => '当 :values 存在时 :attribute不能为空.',
    'required_without' => '当 :values 不存在时 :attribute不能为空.',
    'required_without_all' => '当 :values 都不存在时 :attribute不能为空.',
    'same' => ':attribute和 :other 必须相同.',
    'size' => [
        'numeric' => ':attribute大小必须为 :size.',
        'file' => ':attribute大小必须为 :size kb.',
        'string' => ':attribute必须是 :size 个字符.',
        'array' => ':attribute必须为 :size 个单元.',
    ],
    'string' => ':attribute必须是一个字符串.',
    'timezone' => ':attribute必须是一个合法的时区值.',
    'unique' => ':attribute已经存在.',
    'uploaded' => ':attribute文件未上传.',
    'url' => ':attribute格式不正确.',
    'cn_mobile' => ':attribute不合法.',
    'unique_mobile' => '已存在相同的:attribute.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'mobile' => [
            'required' => ':attribute为必传参数.',
            'size' => ':attribute长度只能为11位.'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'mobile' => '手机号'
    ],
];
