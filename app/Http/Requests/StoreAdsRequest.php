<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdsRequest extends FormRequest
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
            'category_id' => 'int',
            'attributes' => 'array',
            'fileImage' => 'max:2048',
            'phone' => 'string|regex:/^[0-9]/',
            'whatsapp' => 'string|regex:/^[0-9]/',
            'price' => 'numeric',
            'latitude' => 'decimal:2,4',
            'longitude' => 'decimal:2,4',
            'package_id' => 'int',
            'status' => 'boolean',
        ];
    }
}
