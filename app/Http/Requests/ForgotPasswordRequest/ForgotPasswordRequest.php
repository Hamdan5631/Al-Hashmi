<?php

namespace App\Http\Requests\ForgotPasswordRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ForgotPasswordRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        return [
            'mobile_country_code' => ['required'],
            'mobile' => ['required'],
            'password' => ['required'],
        ];
    }
}
