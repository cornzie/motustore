<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'first_name' => 'string|min:2',
            'last_name' => 'string|min:2',
            'phone_number' => 'string|min:5',
            'email' => 'nullable|email|min:2',
            'address_1' => 'nullable|string|min:2',
            'address_2' => 'nullable|string|min:2',
            'city' => 'nullable|string|min:2',
            'region' => 'nullable|string|min:2',
            'postal_code' => 'nullable|string|min:2',
            'country' => 'nullable|string|min:2',
        ];
    }
}
