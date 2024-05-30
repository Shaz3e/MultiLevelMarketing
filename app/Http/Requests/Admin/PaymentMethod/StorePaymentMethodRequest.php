<?php

namespace App\Http\Requests\Admin\PaymentMethod;

use App\Http\Requests\BaseFormRequest;

class StorePaymentMethodRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'icon' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png',
                'max:2048',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'payment_detail' => [
                'required',
                'string',
                'max:255',
            ],
            'is_active' => [
                'required', 'boolean'
            ],
        ];
    }
}
