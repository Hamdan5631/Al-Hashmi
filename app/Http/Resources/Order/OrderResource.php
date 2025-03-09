<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Cart\CartCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Order */
class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uid' => $this->uid,
            'product_name' => $this?->product?->name ?? $this?->carts()->first()?->product?->name,
            'product_image_url' => $this?->product?->image_url,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y'),
            'delivered_at' => $this->getDeliveredAt(),
            'delivery_date' => $this->getDeliveryDate(),
            'pin' => $this->pin,
            'is_cancellable' => $this->isProductCancellable(),
            'district' => $this->district,
            'state' => $this->state,
            'landmark' => $this->landmark,
            'contact_number_country_code' => $this->contact_number_country_code,
            'contact_number' => $this->contact_number,
            'price' => $this->getOrderPrice(),
            'payment_method' => $this->payment_method,
            'tracking_number' => $this->tracking_number,
            'tracking_link' => $this->tracking_link,
            'is_return_product' => $this->isProductReturnable(),
            'status' => $this->status,
            'product' => $this->when(!empty($this?->product), function () {
                return new ProductResource($this->product);
            }),
            'carts' => $this->when($this->carts()->exists(), function () {
                return new CartCollection($this?->carts);
            }),
        ];
    }
}
