<?php

namespace App\Http\Requests\Login;

use App\Enums\Login\LoginTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        return [
            'type' => Rule::in(
                LoginTypeEnum::PASSWORD->value,
                LoginTypeEnum::MOBILE->value,
            ),
            'mobile_country_code' => Rule::when($request->get('type') == LoginTypeEnum::MOBILE->value, ['required']),
            'mobile' => Rule::when($request->get('type') == LoginTypeEnum::MOBILE->value, ['required']),
            'password' => Rule::when($request->get('type') == LoginTypeEnum::PASSWORD->value, ['required']),
        ];
    }
}
