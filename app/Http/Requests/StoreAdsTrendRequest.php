<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdsTrendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|regex:/^[a-zA-Z0-9]/',
            'description' => 'string|regex:/^[a-zA-Z0-9]/',
            'label' => 'string|regex:/^[a-zA-Z0-9]/',
            'fileImage' => 'max:2048',
            'phone' => 'string|regex:/^[0-9]/',
            'whatsapp' => 'string|regex:/^[0-9]/',
            'href' => 'string',
            'package_id' => 'numeric',
            'client_id' => 'int|instance:App\Models\Client',
        ];
    }
}
