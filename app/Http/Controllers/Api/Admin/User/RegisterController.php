<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Exceptions\RegisterFailException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\RegisterRequest;
use App\Http\Services\UserService;

class RegisterController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    /**
     * @throws RegisterFailException
     */
    public function register(RegisterRequest $request)
    {
        $request->validated();
        return apiResponse(0, $this->userService->register($request));
    }
}
