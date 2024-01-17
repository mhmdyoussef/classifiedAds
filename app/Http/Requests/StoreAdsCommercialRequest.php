<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdsCommercialRequest extends FormRequest
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
            'href' => 'string|regex:/^[a-zA-Z0-9]/',
            'package_id' => 'int',
            'price' => 'numeric',
            'is_negotiable' => 'boolean',
        ];
    }
}
