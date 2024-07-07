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
         // Retrieve values from DiligentCreators model or repository
         $defaultPrice = DiligentCreators('default_price');
         $sst = DiligentCreators('sst'); // Assuming 'sst' is stored as a percentage, like 5 for 5%
 
         // Calculate the percentage value
         $sstValue = ($sst / 100) * $defaultPrice;
 
         // Calculate the minimum amount
         $minAmount = $defaultPrice + $sstValue;

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
                'min:' . $minAmount,
                'max:' . $minAmount,
            ],
        ];
    }

    public function messages(): array
    {
        $defaultPrice = DiligentCreators('default_price');
        $sst = DiligentCreators('sst');
        $sstValue = ($sst / 100) * $defaultPrice;
        $minAmount = $defaultPrice + $sstValue;

        return [
            'amount.min' => 'The amount must be at least ' . number_format($minAmount, 2) . '.',
        ];
    }
}
