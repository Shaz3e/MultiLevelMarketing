<?php

namespace App\Http\Requests\Admin\Ledger;

use App\Http\Requests\BaseFormRequest;
use App\Models\Ledger;

class StoreDepositLedgerRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'exists:users,id',
            ],
            'payment_method_id' => [
                'required',
                'exists:payment_methods,id',
            ],
            'deposit' => [
                'required',
                'numeric',
                'gt:0',
                'max_digits:10'
            ],
            'status' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!in_array($value, Ledger::getStatuses())) {
                        $fail('The status must be a valid ledger status.');
                    }
                },
            ],
        ];
    }
}
