<?php

namespace App\Http\Resources\Product;

use App\Enums\Carts\CartStatusEnum;
use App\Http\Resources\ProductBidding\ProductBiddingCollection;
use App\Http\Resources\ProductBidding\ProductBiddingResource;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

/** @mixin Product */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $createdAt = Carbon::parse($this->created_at);
        $adjustedTime = $createdAt->copy()->addHours($this->bidding_time);
        $diff = $createdAt->diff($adjustedTime);

        $token = $request->bearerToken();
        $token = PersonalAccessToken::findToken($token);
        $user = optional($token)->tokenable;

        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'category' => $this->category->name,
            'name' => $this->name,
            'name_called' => $this->name_called,
            'gender' => $this->gender,
            'weight' => $this->weight,
            'document_url' => $this->document_url,
            'colour' => $this->colour,
            'breed' => $this->breed,
            'age_month' => $this->age_month,
            'age_year' => $this->age_year,
            'description' => $this->description,
            'location' => $this->location,
            'price' => $this->price,
            'actual_price' => $this->actual_price,
            'quantity' => $this->quantity,
            'is_veg' => $this->is_veg,
            'shipping_charge' => $this->shipping_charge,
            'estimated_delivery' => $this->estimated_delivery,
            'is_return_product' => $this->is_return_product,
            'return_period' => $this->return_period,
            'is_on_time_return' => $this->on_time_return,
            'is_featured' => $this->is_featured,
            'flavour' => $this->flavour,
            'specific_use' => $this->specific_use,
            'brand' => $this->brand,
            'age_range' => $this->age_range,
            'item_form' => $this->item_form,
            'ingredients' => $this->ingredients,
            'is_trending' => $this->is_trending,
            'is_vaccinated' => $this->is_vaccinated,
            'can_bid' => $this->canBid($user?->id),
            'is_you_won' => $this->isYouWon($user?->id),
            'is_winning_card_visible' => $this->isWinningCardVisible(),
            'is_you_participated' => $this->isYouParticipated($user?->id, $this->id),
            'is_wishlist_product' => $this->isWishlistProduct($user?->id),
            'is_product_purchased' => $this->getIsProductPurchased(),
            'your_bidding_price' => $this->myLatestBiddingPrice(),
            'image_url' => $this->getProductImage(),
            'images' => $this->getProductImages(),
            'total_bids' => $this->productBidding()->count(),
            'bid_time' => sprintf('%02d:%02d:%02d', $diff->h, $diff->i, $diff->s),
            'updated_at' => $this->updated_at,
            'is_bidding_ended' => Carbon::now()->greaterThan(Carbon::parse($this->bidding_end_time)),
            'bidding_end_time' => $this->bidding_end_time,
            'bidding_duration' => $this->getDurationAttribute(),
            'bidding_start_time' => $this->getBiddingStartTime(),
            'is_bidding_started' => $this->is_bidding_started,
            'is_store_product' => $this->is_store_product,
            'is_product_in_cart' => Auth::check() && $this->isProductInCart(),
            'product_bidding' => Auth::check() ? new ProductBiddingCollection($this?->productBidding()->latest()->get()) : null,
            'first_product_bidding' => new ProductBiddingResource($this?->productBidding()
                ?->orderBy('created_at', 'asc')?->first()),
            'last_product_bidding' => new ProductBiddingResource($this?->productBidding()?->latest()?->first()),
            'your_bidding' => new ProductBiddingResource($this->productBidding()?->where('user_id', $user?->id)?->latest()?->first()),

        ];
    }

    public function myLatestBiddingPrice(): ?string
    {
        $productBidding = $this->productBidding()->where('user_id', Auth::id())->latest()->first();

        if (!empty($productBidding?->bidding_price)) {
            return $productBidding?->bidding_price;
        }

        return null;
    }

    private function isProductInCart(): bool
    {
        if (Cart::query()->where('user_id', Auth::id())
            ->where('product_id', $this->id)
            ->where('status', CartStatusEnum::Pending)
            ->exists()) {
            return true;
        }

        return false;
    }
}
