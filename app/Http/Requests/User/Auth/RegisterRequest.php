<?php

namespace App\Http\Requests\User\Auth;

use App\Http\Requests\BaseFormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique(User::class,'email'),
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique(User::class,'phone'),
            ],
            'password' => [
                'required',
                'min:8',
                'max:255',
            ],
            'confirm_password' => [
                'required',
                'same:password',
            ],
            'qr_code' => [
                'nullable',
                'string',
            ],
            'referral_code' => [
                'required',
                'string',
                Rule::exists('users','referral_code'),
            ],
            'pin_code' => [
                'required',
                'string',
                Rule::exists('pin_codes','pin_code'),
            ],
            'terms' => [
                'required'
            ],
        ];
    }

    public function messages()
    {
        return [
            'terms.required' => 'Please accept our terms and conditions.',
        ];
    }
}
