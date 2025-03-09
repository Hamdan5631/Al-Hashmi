<?php

namespace App\Http\Resources\Payment;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Payment */
class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payment_amount' => $this->payment_amount / 100,
            'is_coin_purchase' => $this->is_coin_purchase,
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/y'),
        ];
    }
}
