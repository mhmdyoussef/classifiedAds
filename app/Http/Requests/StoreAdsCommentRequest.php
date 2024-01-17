<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdsCommentRequest extends FormRequest
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
            'comment' => 'required|string|min:5|max:255|regex:/^[a-zA-Z0-9]/|sanitize_html'
        ];
    }

    /**
     * @param $validator
     * @return void
     * Sanitizing comment against XSS
     */
    public function withValidator($validator)
    {
        $validator->addExtension('sanitize_html', function ($attribute, $value, $parameters, $validator) {
            // Sanitize HTML using htmlspecialchars
            $sanitizedValue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            // Replace the original value with the sanitized value
            $validator->getData()[$attribute] = $sanitizedValue;

            return true;
        });
    }
}
