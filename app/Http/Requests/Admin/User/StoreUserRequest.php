<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => [
                'required', 'string', 'max:255',
            ],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'company_id' => [
                'nullable',
                Rule::exists('companies', 'id'),
            ],
            'pin_code' => [
                'nullable',
                // Rule::exists('pin_codes', 'pin_code'),
                Rule::exists('pin_codes', 'pin_code')->where(function ($query) {
                    $query->where('is_used', 0);
                }),
            ],
            'phone' => ['nullable', 'max:30'],
            'address' => ['nullable', 'max:255'],
            'country' => ['nullable', 'max:100'],
            'state' => ['nullable', 'max:100'],
            'city' => ['nullable', 'max:100'],
            'zip_code' => [
                'nullable', 'max:10'
            ],
            'is_email_verified' => ['required', 'boolean'],
            'is_phone_verified' => ['required', 'boolean'],
            'is_kyc_verified' => ['required', 'boolean'],
            'is_active' => [
                'required', 'boolean',
            ],
        ];

        if ($this->method() === 'POST') {
            $rules = array_merge($rules, [
                'password' => [
                    'required', 'string', 'min:8', 'max:255',
                ],
            ]);
        } else {
            $rules = array_merge($rules, [
                'password' => [
                    'nullable', 'string', 'min:8', 'max:255',
                ],
            ]);
        }

        return $rules;
    }
}
