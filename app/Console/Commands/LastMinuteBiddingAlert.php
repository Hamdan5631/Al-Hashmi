<?php

namespace App\Console\Commands;

use App\Enums\Products\ProductStatusEnum;
use App\Helpers\UserNotifications\NotificationToUser;
use App\Models\Product;
use App\Models\ProductBidding;
use App\Models\User;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LastMinuteBiddingAlert extends Command
{
    protected $signature = 'bidding:last-minute-bidding-alert';

    protected $description = 'Alert employees just before the last minute bidding alert';

    public function handle(): void
    {
        $products = Product::query()
            ->where('status', ProductStatusEnum::Active->value)
            ->where('is_store_product', false)
            ->where('bidding_end_time', '<=', Carbon::now()->addMinute())
            ->get();

        foreach ($products as $product) {

            $bidders = ProductBidding::query()
                ->where('product_id', $product->id)
                ->whereNotNull('bidding_price')
                ->distinct()
                ->pluck('user_id');

            $users = User::query()
                ->whereIn('id', $bidders)
                ->get();

            $notificationExists = UserNotification::query()
                ->where('type', 'lastMinuteBiddingAlert')
                ->whereIn('user_id', $bidders)
                ->where('reference_id', $product?->id)
                ->exists();

            if (!$notificationExists) {
                $bidderTitle = "Bidding Closing Soon!";
                $bidderMessage = "The bidding for {$product->name} is about to end in 1 minute! Don't miss out on your chance to win.";

                foreach ($users as $bidder) {
                    NotificationToUser::sent($bidder, $bidderTitle, $bidderMessage, 'lastMinuteBiddingAlert', $product);
                }
            }

        }
    }
}
