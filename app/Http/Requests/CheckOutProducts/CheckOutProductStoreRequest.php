<?php

namespace App\Http\Requests\CheckOutProducts;

use App\Enums\Payment\PaymentMethod;
use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CheckOutProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        return [
            'cart_ids' => ['required',  'array'],
            'address_id' => ['required',  Rule::exists('addresses', 'id')],
            'payment_method' => ['required',  Rule::in([PaymentMethod::ONLINE, PaymentMethod::CASH_ON_DELIVERY])],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function passedValidation(): void
    {
        foreach (Cart::query()
                     ->whereIn('id', $this->get('product_ids'))
                     ->cursor() as $cart) {

            if ($cart->product->quantity < $cart->quantity) {
                $name = $cart->product->name;

                throw ValidationException::withMessages([
                    $cart->product_id => "We apologize, but this $name product is temporarily out of stock. Please check back later or contact support for more information",
                ]);
            }
        }
    }
}
