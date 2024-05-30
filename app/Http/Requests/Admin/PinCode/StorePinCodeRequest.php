<?php

namespace App\Http\Requests\Admin\PinCode;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

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
            'pin_code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('pin_codes', 'pin_code')->ignore($this->pin),
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
