<?php

namespace App\Http\Requests\Admin\Menu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'url' => ['required'],
            'permission_name' => ['required'],
            'type' => ['required','in:1,0'],
            'open_status' => ['required','in:0,1'],
            'status' => ['required','in:1,0']
        ];
    }
}
