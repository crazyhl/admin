<?php

use Illuminate\Http\JsonResponse;

if (! function_exists('apiResponse')) {
    /**
     * api 用的全局返回方法
     *
     * @param int $code
     * @param mixed $data
     * @param string $message
     * @return JsonResponse
     */
    function apiResponse(int $code, mixed $data, string $message = '', int $httpStatusCode = 200): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $httpStatusCode);
    }
}
