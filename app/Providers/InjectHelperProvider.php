<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class InjectHelperProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // 遍历文件进行注册
        foreach (glob(app_path("Helpers/*.php")) as $filename) {
            require_once $filename;
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
