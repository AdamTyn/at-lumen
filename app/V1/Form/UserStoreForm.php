<?php

namespace App\V1\Form;

use App\Base\BaseForm;
use Illuminate\Http\Request;

class UserStoreForm extends BaseForm
{
    const FORM_NAME = 'UserStoreForm';

    public function handle(Request $request)
    {
        validator($request->all(), [
            'mobile' => 'required|cn_mobile', // cn_mobile 是自定义的验证规则，表示只支持国内手机号
            'email' => 'required|email',
            'name' => 'required|between:6,12',
            'code' => 'required'
        ], [
            'code.required' => __('I am AdamTyn')
        ])->validate();
    }
}
