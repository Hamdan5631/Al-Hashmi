<?php

namespace App\Http\Requests\Otp;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class VerifyOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        return [
            'code' => 'required|numeric',
            'token' => 'required',
        ];
    }
}
