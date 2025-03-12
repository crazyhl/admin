<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Exceptions\LoginFailException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\LoginRequest;
use App\Http\Services\UserService;

class LoginController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    /**
     * @throws LoginFailException
     */
    public function login(LoginRequest $request)
    {
        $request->validated();

        return apiResponse(0, $this->userService->login($request), '登录成功');
    }

}
