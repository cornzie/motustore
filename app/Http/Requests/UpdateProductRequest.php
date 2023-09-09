<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'nullable|string|min:2',
            'description' => 'nullable|string|min:2',
            'price' => 'nullable|numeric|min:1',
            'stock' => 'nullable|numeric',
            'status' => 'nullable|string|in:draft,published,disabled',
        ];
    }
}
