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
            'password' => [
                'required',
                'min:8',
                'max:255',
            ],
            'confirm_password' => [
                'required',
                'same:password',
            ],
            'pin_code' => [
                'required',
                Rule::exists('pin_codes', 'pin_code')->where( function($query){
                    $query->where('is_used', 0);
                }),
            ],
        ];
    }
}
