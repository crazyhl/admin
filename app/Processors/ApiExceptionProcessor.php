<?php

namespace App\Processors;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Api 请求异常处理器
 */
class ApiExceptionProcessor
{
    public function process(Exception $e, Request $request): JsonResponse
    {
        logger()->error('exception', [$e]);
        $message = $e->getMessage();
        if ($e instanceof AuthenticationException) {
            $code = 401;
        } else if ($e instanceof UniqueConstraintViolationException) {
            // 其实这里可以不用在这边实现，全部在 request 里面自定义就好了。等后期完善的时候修改这里
            $code = 500;
            // 唯一键验证错误
            if ($request->routeIs('auth.register')) {
                $message = '用户名重复';
            }
        } else {
            $code = $e->status ?? ($e->getCode() ?: 500);
        }

        $data = [];
        if (config('app.env') !== 'production') {
            $data['file'] = $e->getFile();
            $data['line'] = $e->getLine();
            $data['trace'] = $e->getTrace();
            logger()->error($e);
        }
        return apiResponse($code, $data, $message, $code);
    }
}
