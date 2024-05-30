<?php

namespace App\Http\Requests\Admin\Ranking;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreRankingRequest extends BaseFormRequest
{/**
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
            'level' => [
                'required',
                'integer',
                'min:1',
                'max:99',
                Rule::unique('rankings', 'level')->ignore($this->ranking),
            ],
            'name' => [
                'required',
                'string',
                Rule::unique('rankings', 'name')->ignore($this->ranking),
            ],
            'reward' => [
                'nullable',
                'string',
                'max:255',
            ],
            'reward_image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png',
                'max:2048',
            ],
            'bonus_point' => [
                'nullable',
                'numeric',
                'max_digits:7',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}
