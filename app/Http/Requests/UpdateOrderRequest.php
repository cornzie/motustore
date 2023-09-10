<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'shipping_due_date' => 'required|date',
            'shipping_address' => 'nullable|string',
            'delivery_method' => 'required|string|in:pickup,delivery',
            'products' => 'array|required',
            'products.*.id' => 'nullable|exists:products,id',
        ];
    }
}
