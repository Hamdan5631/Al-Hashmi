<?php

namespace App\Http\Resources\ProductBidding;

use App\Models\ProductBidding;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ProductBidding */
class ProductBiddingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'bidding_price' => $this->bidding_price,
            'is_won' => $this->is_won,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
