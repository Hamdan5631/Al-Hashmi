<?php

namespace App\Http\Controllers\Api\V1\PlaceBid;

use App\Helpers\Firebase\FirebaseHelper;
use App\Helpers\UserNotifications\NotificationToUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceBid\PlaceBidRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Models\ProductBidding;
use App\Models\User;
use App\Models\UserProductBidding;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class PlaceBidController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(PlaceBidRequest $request): JsonResponse
    {
        $amount = $request->get('amount');
        $productId = $request->get('product_id');
        $user = User::query()->findOrFail(Auth::id());
        $product = Product::query()->findOrFail($productId);

        if (Carbon::now()->greaterThan(Carbon::parse($product->bidding_end_time))) {
            return $this->error("Bidding for $product->name has ended.", null, 422);
        }

        DB::beginTransaction();

        try {
            $latestProductBidding = ProductBidding::query()
                ->where('product_id', $productId)
                ->lockForUpdate()
                ->latest()
                ->first();

            if ($latestProductBidding?->user_id == $user->id) {
                return $this->error('You cannot bid on the product that you last bid on', null, 422);
            }

            $userProductBidding = UserProductBidding::query()
                ->where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

            if (!$userProductBidding) {
                $userProductBidding = new UserProductBidding();
                $userProductBidding->user_id = $user->id;
                $userProductBidding->product_id = $product->id;
                $userProductBidding->is_purchased = false;
                $userProductBidding->save();
            }

            if ($latestProductBidding && $amount <= $latestProductBidding->bidding_price) {
                DB::rollBack();
                return $this->error("Bid amount must be higher than $latestProductBidding->bidding_price", null, 422);
            }

            if ($latestProductBidding) {
                $latestProductBidding->is_won = false;
                $latestProductBidding->save();
            }

            $productBidding = new ProductBidding();
            $productBidding->product_id = $product->id;
            $productBidding->user_id = $user->id;
            $productBidding->bidding_price = $amount;
            $productBidding->is_won = true;
            $productBidding->save();

            $user->coins -= 1;
            $user->save();

            $isFirstBid = !$latestProductBidding;

            if ($isFirstBid) {
                $users = User::query()
                    ->where('id', '!=', $user->id)
                    ->cursor();

                $userTitle = "Bidding Started!";
                $userMessage = "Bidding has officially started for the {$product->name}. Place your bids now and don't miss out!";
                foreach ($users as $user) {
                    NotificationToUser::sent($user, $userTitle, $userMessage, 'Notification', $product);
                }
            }

            FirebaseHelper::updateBiddingData($productBidding->product);

            DB::commit();
            return $this->jsonResponse('success', new ProductResource($product), 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('An error occurred while placing the bid.', null, 500);
        }
    }

}
