<?php

namespace App\Http\Requests\Cart;

use App\Enums\Carts\CartStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class QuantityChangeRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        return [
            'cart_id' => ['required',  Rule::exists('carts', 'id')
                ->where('user_id', Auth::id())->where('status', CartStatusEnum::Pending)],
            'quantity' => ['required', 'numeric', 'min:1'],
        ];
    }
}
