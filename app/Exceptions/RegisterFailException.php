<?php

namespace App\Exceptions;

use Exception;

class RegisterFailException extends Exception
{
    protected $message = '注册失败';
}
