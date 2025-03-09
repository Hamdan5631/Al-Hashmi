<?php

namespace App\Http\Resources\Cart;

use App\Http\Resources\Product\ProductResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Cart */
class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_name' => $this->product->category->name.' Foods',
            'name' => $this->product->name,
            'weight' => $this->product->weight,
            'price' => $this->product->price,
            'quantity' => $this->quantity,
            'image' => $this->product->getProductImage(),
            'product' => new ProductResource($this->product),
        ];
    }
}
