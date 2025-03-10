<?php

namespace App\Http\Controllers\Api\Admin\Utils;

use Illuminate\Http\Request;

class CaptchaController
{
    public function captcha()
    {
        $captchaData = app('captcha')->create('default', true);
//        dd($captchaData);
        return apiResponse(0, [
            'img' => $captchaData['img']->toDataUri(),
            'key' => $captchaData['key'],
        ]);
    }
}
