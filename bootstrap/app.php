<?php

use App\Processors\ApiExceptionProcessor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // 修正为异常输出 待测试
        $exceptions->render(function (Exception $e, Request $request) {
            // 判定是否 json 输出
            if ($request->expectsJson()) {
                return app(ApiExceptionProcessor::class)->process($e, $request);
            }
            return false;
        });
    })->create();
