<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,NULL,id,deleted_at,NULL',
            'mobile_country_code' => 'required',
            'mobile' => 'required|unique:employees,mobile,NULL,id,deleted_at,NULL',
            'password' => 'required|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'password.regex' => 'Password must be minimum 8 characters.',
        ];
    }
}
