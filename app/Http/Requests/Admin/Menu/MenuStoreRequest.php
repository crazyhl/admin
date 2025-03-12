<?php

namespace App\Http\Requests\Admin\Menu;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;

class MenuStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Menu::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'url' => ['required', 'string', 'exclude_if:type,1'],
            'permission_name' => ['required', 'string', 'exclude_if:type,1'],
            'sort' => ['required', 'integer', 'min:0'],
            'type' => ['required', 'integer', 'in:0,1'],
            'parent_id' => ['required', 'integer', 'min:1'],
            'open_status' => ['required', 'integer', 'in:0,1'],
            'status' => ['required', 'integer', 'in:0,1'],
        ];
    }
}
