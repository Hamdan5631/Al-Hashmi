<?php

namespace App\Http\Requests\PlaceBid;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlaceBidRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        return [
            'amount' => 'required',
            'product_id' => ['required',  Rule::exists('products', 'id')],
        ];
    }
}
