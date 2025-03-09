<?php

namespace App\Http\Requests\Transmit;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(Request $request): array
    {
        return [
            'product_id' => ['required',  Rule::exists('products', 'id')],
            'user_id' => ['required', Rule::exists('employees', 'id')],
        ];
    }
}
