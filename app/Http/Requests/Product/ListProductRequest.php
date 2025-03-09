<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(Request $request): array
    {
        return [
            'category_id' => [
                Rule::when($request->get('category_id'),
                    ['required',  Rule::exists('categories', 'id')])
            ],
        ];
    }
}
