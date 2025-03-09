<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductCalculationsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(Request $request): array
    {
        return [
            'is_single_product' => ['required', 'boolean'],
            'product_id' => [Rule::when($request->get('is_single_product'), ['required',  Rule::exists('products', 'id')])],
            'product_ids' => [Rule::when($request->get('is_single_product') == false, ['required', 'array'])]
        ];
    }
}
