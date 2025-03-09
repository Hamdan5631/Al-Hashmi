<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        return [
            'product_id' => ['required',  Rule::exists('products', 'id')],
            'quantity' => ['required', 'numeric', 'min:1'],
        ];
    }
}
