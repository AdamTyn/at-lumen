<?php

namespace App\V1\Controllers;

use App\V1\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        # 表示只对 store 启用 form 中间件
        # form:App\\V1\\Form\\UserStoreForm 同时也指定了表单验证类 App\V1\Form\UserStoreForm::class
        $this->middleware('form:App\\V1\\Form\\UserStoreForm', ['only' => ['store']]);
    }

    public function index()
    {
        $users[] = [
            'name' => 'AdamTyn',
            'email' => 'tynadam@foxmail.com',
            'mobile' => '1888888888',
        ];

        success(UserResource::collection($users));
    }

    public function show()
    {
        $user = [
            'name' => 'AdamTyn',
            'email' => 'tynadam@foxmail.com',
            'mobile' => '1888888888',
        ];

        success(new UserResource($user));
    }

    public function store(Request $request)
    {
        // do somethings

        success($request->all());
    }
}
