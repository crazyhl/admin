<?php

namespace App\Http\Controllers\Api\Admin;

use App\Exceptions\LoginFailException;
use App\Exceptions\RegisterFailException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\LoginRequest;
use App\Http\Requests\Admin\User\RegisterRequest;
use App\Http\Services\UserService;

class AuthController extends Controller
{
    //
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

    /**
     * @throws RegisterFailException
     */
    public function register(RegisterRequest $request)
    {
        $request->validated();
        return apiResponse(0, $this->userService->register($request));
    }

    public function logout()
    {
        $this->userService->logout();
        return apiResponse(0, [], '退出成功');
    }
}
