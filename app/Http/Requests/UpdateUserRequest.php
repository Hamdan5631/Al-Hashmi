<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        return [
            'name' => Rule::when($request->has('name'), ['required']),
            'email' => Rule::when($request->has('email'), ['required']),
            'mobile_country_code' => Rule::when($request->has('mobile_country_code'), ['required']),
            'mobile' => Rule::when($request->has('mobile'), ['required', 'unique:employees']),
            'profile_image' => Rule::when($request->has('profile_image'), ['required', 'unique:employees']),
        ];
    }
}
