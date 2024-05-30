<?php

namespace App\Http\Requests\Admin\PinCode;

use App\Http\Requests\BaseFormRequest;

class StorePinCodeRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'pin' => [
                'required',
                'string',
                'max:10',
                'unique:pin_codes,pin',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0',
                'max:1000000000',
            ],
        ];
    }
}
