<?php

namespace App\Console\Commands;

use App\Enums\Products\ProductStatusEnum;
use App\Helpers\Firebase\FirebaseHelper;
use App\Helpers\UserNotifications\NotificationToUser;
use App\Models\ProductBidding;
use App\Models\UserNotification;
use Illuminate\Console\Command;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateBiddingStatus extends Command
{
    protected $signature = 'update:bidding-status';
    protected $description = 'Update is_bidding_started for products when bidding_start_time occurs';

    public function handle(): void
    {
        $currentTime = Carbon::now();

        Product::query()
            ->where('status', ProductStatusEnum::Active->value)
            ->where('is_store_product', false)
            ->get()
            ->each(function (Product $product) use ($currentTime) {
                $biddingStartTime = null;

                if ($product->bidding_start_time) {
                    try {
                        $biddingStartTime = Carbon::createFromFormat('Y-m-d H:i:s', $product->bidding_start_time, 'Asia/Kolkata');
                    } catch (\Exception $e) {
                        Log::error("Invalid bidding_start_time for product ID {$product->id}: " . $e->getMessage());
                    }
                }

                if ($biddingStartTime && $biddingStartTime->isSameMinute($currentTime) && !$product->is_bidding_started) {

                    $product->is_bidding_started = true;

                    $timeToAdd = $product->bidding_time;

                    $biddingEndTime = Carbon::now()->addMinutes($timeToAdd);

                    $product->bidding_end_time = $biddingEndTime;

                    $product->save();

                    FirebaseHelper::updateBiddingData($product);

                    if ($product->wishlist) {
                        foreach ($product->wishlist as $wishlist) {
                            $userTitle = "Bidding Started!";
                            $userMessage = "Bidding has officially started for your saved {$product->name}. Place your bids now and don't miss out!";

                            NotificationToUser::sent($wishlist?->user, $userTitle, $userMessage, 'Notification', $product);
                        }
                    }
                }

                if ($product->is_bidding_started && Carbon::parse($product->bidding_end_time) <= Carbon::now()) {

                    $productBidding = ProductBidding::query()
                        ->where('is_won', true)
                        ->where('product_id', $product->id)
                        ->first();

                    $productBiddingCounts = ProductBidding::query()
                        ->where('product_id', $product->id)
//                        ->where('bidding_price', '>', $productBidding?->bidding_price)
                        ->when($productBidding?->bidding_price !== null, function ($query) use ($productBidding) {
                            return $query->where('bidding_price', '>', $productBidding->bidding_price);
                        })
                        ->count();

                    if ($productBidding &&
                        $productBiddingCounts == 0) {

                        $notificationExists = UserNotification::query()
                            ->where('type', 'wonNotification')
                            ->where('user_id', $productBidding->user_id)
                            ->where('reference_id', $product?->id)
                            ->exists();

                        if (!$notificationExists) {
                            $productBidding = ProductBidding::query()
                                ->where('product_id', $product->id)
                                ->where('is_won', true)
                                ->orderByDesc('bidding_price')
                                ->first();

                            $productBidding->updated_at = Carbon::now();
                            $productBidding->save();

                            FirebaseHelper::updateBiddingData($product);

                            $bidderTitle = "Congratulations! You Won the Bid!";
                            $bidderMessage = "Congratulations {$productBidding->user?->name}, you won the bid for the {$product?->name} at {$productBidding?->bidding_price}. Please complete your purchase within 5 minutes!";

                            try {
                                NotificationToUser::sent($productBidding?->user, $bidderTitle, $bidderMessage, 'wonNotification', $product);
                            } catch (\Exception $e) {
                                Log::error('Failed to send notification: ' . $e->getMessage(), ['product_id' => $product->id]);
                            }

                        }
                    }
                }

            });

        $this->info('Bidding has been started.');
    }


}
