<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Exceptions\RegisterFailException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

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
