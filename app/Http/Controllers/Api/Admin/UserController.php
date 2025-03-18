<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function info()
    {
        $isSuperAdmin = auth()->user()->hasRole('super-admin');
        $user = auth()->user();
        return apiResponse(0, [
            'isSuperAdmin' => $isSuperAdmin,
            'user' => $user,
        ],'');
    }
}
