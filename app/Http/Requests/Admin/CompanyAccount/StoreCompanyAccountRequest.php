<?php

namespace App\Http\Requests\Admin\CompanyAccount;

use App\Http\Requests\BaseFormRequest;

class StoreCompanyAccountRequest extends BaseFormRequest
{/**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'starting_balance' => [                
                'required',
                'numeric',
                'min:0',
                'max:1000000000',
            ]
        ];
    }
}
