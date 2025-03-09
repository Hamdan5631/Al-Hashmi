<?php

namespace App\Http\Requests\ProductWishList;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(Request $request): array
    {
        return [
            'product_id' => ['required',  Rule::exists('products', 'id')],
            'add_to_wish_list' => ['required'],
        ];
    }
}
