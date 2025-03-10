<?php

namespace App\Exceptions;

use Exception;

class LoginFailException extends Exception
{
    protected $message = '用户名或密码不正确';
}
