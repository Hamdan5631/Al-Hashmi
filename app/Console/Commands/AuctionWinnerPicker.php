<?php

namespace App\Console\Commands;

use App\Enums\Products\ProductStatusEnum;
use App\Helpers\Firebase\FirebaseHelper;
use App\Helpers\UserNotifications\NotificationToUser;
use App\Models\Product;
use App\Models\ProductBidding;
use App\Models\UserNotification;
use App\Models\UserProductBidding;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AuctionWinnerPicker extends Command
{
    protected $signature = 'bidding:auction-winner';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $products = Product::query()
            ->where('status', ProductStatusEnum::Active->value)
            ->where('is_store_product', false)
            ->where('bidding_end_time', '<=', Carbon::now())
            ->get();

        foreach ($products as $product) {
            $productBidding = ProductBidding::query()
                ->where('is_won', true)
                ->where('product_id', $product->id)
                ->first();

            if (!$productBidding && $product->is_bidding_started &&
                Carbon::parse($product->bidding_end_time) <= Carbon::now()) {
                $product->status = ProductStatusEnum::InActive->value;
                $product->save();

                return;
            }

            $userProductBidding = UserProductBidding::query()
                ->where('user_id', $productBidding?->user_id)
                ->where('product_id', $product->id)
                ->where('is_purchased', true)
                ->first();

            if ($userProductBidding) {
                return;
            }

            $productBiddingCounts = ProductBidding::query()
                ->where('product_id', $product->id)
                ->where('bidding_price', '>', $productBidding?->bidding_price)
                ->count();

            if ($productBidding &&
                $productBiddingCounts == 0 &&
                Carbon::parse($product->bidding_end_time)->addMinutes(5) <= Carbon::now()) {

                $lastWon = ProductBidding::query()
                    ->where('product_id', $product->id)
                    ->where('is_won', true)
                    ->first();

                $nextWon = ProductBidding::query()
                    ->where('product_id', $product->id)
                    ->where('bidding_price', '<', $lastWon?->bidding_price)
                    ->orderBy('bidding_price', 'desc')
                    ->first();

                if ($nextWon) {

                    $notificationExists = UserNotification::query()
                        ->where('type', 'wonNotification')
                        ->where('user_id', $userProductBidding?->user_id)
                        ->where('reference_id', $product?->id)
                        ->exists();

                    if (!$notificationExists) {
                        $bidderTitle = "Congratulations! You Won the Bid!";
                        $bidderMessage = "Congratulations {$nextWon->user?->name}, you won the bid for the {$product?->name} at {$nextWon?->bidding_price}. Please complete your purchase within 5 minute!";

                        FirebaseHelper::updateBiddingData($productBidding->product);
                        NotificationToUser::sent($nextWon->user, $bidderTitle, $bidderMessage, 'wonNotification', $product);
                    }
                }

                if (!$nextWon) {
                    $product->status = ProductStatusEnum::InActive->value;
                    $product->save();

                    return;
                }

                $lastWon->is_won = false;
                $lastWon->save();

                $nextWon->is_won = true;
                $nextWon->save();

                FirebaseHelper::updateBiddingData($productBidding->product);
            }

            if ($productBiddingCounts >= 1 &&
                Carbon::parse($productBidding->updated_at)->addMinutes(5) <= Carbon::now()) {
                $product->status = ProductStatusEnum::InActive->value;
                $product->save();

                FirebaseHelper::updateBiddingData($productBidding->product);
            }

            if (Carbon::parse($product->bidding_end_time)->addMinutes(10) <= Carbon::now()) {
                $product->status = ProductStatusEnum::InActive->value;
                $product->save();

                FirebaseHelper::updateBiddingData($productBidding->product);
            }

        }
    }
}
