<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'phone_number' => 'required|string',
            'products' => 'required|array',
            'products.*.id' => 'required|numeric|exists:products,id',
            'products.*.quantity' => 'required|numeric',
        ];
    }
}
