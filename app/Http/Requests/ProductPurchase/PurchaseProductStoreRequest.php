<?php

namespace App\Http\Requests\ProductPurchase;

use App\Enums\Order\OrderTypeEnum;
use App\Enums\Payment\PaymentMethod;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PurchaseProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        return [
            'type' => ['required',  Rule::in([OrderTypeEnum::StoreOrder, OrderTypeEnum::BiddingOrder])],
            'product_id' => ['required',  Rule::exists('products', 'id')],
            'address_id' => ['required',  Rule::exists('addresses', 'id')],
            'payment_method' => ['required',  Rule::in([PaymentMethod::ONLINE, PaymentMethod::CASH_ON_DELIVERY])],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function passedValidation(): void
    {
        if ($this->get('type') == OrderTypeEnum::StoreOrder) {
            $product = Product::query()->findOrFail($this->get('product_id'));
            if ($product->quantity == 0) {
                throw ValidationException::withMessages([
                    'product_id' => "We apologize, but this product is temporarily out of stock. Please check back later or contact support for more information",
                ]);
            }
        }
    }
}
