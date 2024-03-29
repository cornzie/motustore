<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'phone_number' => 'required|string|min:5',
            'email' => 'required|email|min:2',
            'address_1' => 'required|string|min:2',
            'address_2' => 'nullable|string|min:2',
            'city' => 'nullable|string|min:2',
            'region' => 'nullable|string|min:2',
            'postal_code' => 'nullable|string|min:2',
            'country' => 'nullable|string|min:2',
        ];
    }
}
