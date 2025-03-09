<?php

namespace App\Http\Resources\User;

use App\Enums\Order\OrderTypeEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile_country_code' => $this->mobile_country_code,
            'mobile' => $this->mobile,
            'my_coins' => $this->coins,
            'profile_image_url' => $this->profile_image_url,
            'bids_participated' => $this->userProductBidding()->count(),
            'bids_won' => $this->productBidding()->where('is_won',true)->count(),
            'items_bought' => $this->orders()->where('type',OrderTypeEnum::BiddingOrder->value)->count(),
        ];
    }
}
