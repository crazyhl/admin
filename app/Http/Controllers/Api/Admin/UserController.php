<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function info()
    {
        $user = auth()->user();
        return apiResponse(0, [
            'isSuperAdmin' => $user->hasRole('super-admin'),
            'permissions' => $user->getAllPermissions(),
            'user' => $user,
        ],'');
    }
}
