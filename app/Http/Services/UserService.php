<?php

namespace App\Http\Services;

use App\Exceptions\LoginFailException;
use App\Exceptions\RegisterFailException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @throws LoginFailException
     */
    public function login(Request $request): array
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new LoginFailException();
        }

        return [
            'token' => Auth::getUser()->createToken($request->device)->plainTextToken,
            'type' => 'Bearer',
        ];
    }

    /**
     * @throws RegisterFailException
     */
    public function register(Request $request): array
    {
        // 验证通过执行注册
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->email;
        $user->password = bcrypt($request->password);
        if ($user->save()) {
            return [
                'token' => $user->createToken($request->device)->plainTextToken,
                'type' => 'Bearer',
            ];
        } else {
            throw new RegisterFailException();
        }
    }
}
