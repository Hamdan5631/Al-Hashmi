<?php

namespace App\Http\Controllers\Api\V1\PurchaseProduct;

use App\Enums\Order\OrderStatus;
use App\Enums\Order\OrderTypeEnum;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Payment\StatusEnum;
use App\Enums\Products\ProductStatusEnum;
use App\Enums\UserNotifications\UserNotificationMsg;
use App\Handler\Razorpay\Razorpay;
use App\Helpers\Firebase\FirebaseHelper;
use App\Helpers\UserNotifications\NotificationToUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductPurchase\PurchaseProductStoreRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductBidding;
use App\Models\User;
use App\Models\UserProductBidding;
use App\Notifications\SendNotificationForProductSoldOut;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\Notification;
use function Laravel\Prompts\error;

/**
 * @property Razorpay $action
 */
class PurchaseProductController extends Controller
{
    public function __construct(Razorpay $action)
    {
        $this->action = $action;
    }

    /**
     * @throws Throwable
     */
    public function __invoke(PurchaseProductStoreRequest $request): JsonResponse
    {
        $user = User::query()->findOrFail(Auth::id());
        $product = Product::query()->findOrFail($request->get('product_id'));
        $address = Address::query()->findOrFail($request->get('address_id'));
        $paymentMethod = $request->get('payment_method');

        if ($product->status == ProductStatusEnum::InActive->value) {
            return $this->jsonResponse("Time's up! The 5-minute window to buy the product '{$product->name}' has expired.", $payment ?? null, 200);
        }

        $order = new Order();
        $order->uid = $order->getLatestUid();
        $order->product_id = $product->id;
        $order->user_id = $user->id;
        $order->address_id = $address->id;
        $order->name = $address->name;
        $order->address_line_1 = $address->address_line_1;
        $order->address_line_2 = $address->address_line_2;
        $order->pin = $address->pin;
        $order->district = $address->district;
        $order->state = $address->state;
        $order->landmark = $address->landmark;
        $order->contact_number_country_code = $address->contact_number_country_code;
        $order->contact_number = $address->contact_number;
        $order->payment_method = $paymentMethod;
        $order->type = $request->get('type');

        if ($paymentMethod == PaymentMethod::CASH_ON_DELIVERY->value) {
            $order->status = OrderStatus::ORDER_PLACED;
        }

        if ($paymentMethod == PaymentMethod::ONLINE->value) {
            $order->status = OrderStatus::ORDER_PENDING;
        }

        if ($request->get('type') == OrderTypeEnum::BiddingOrder->value) {
            $productBidding = ProductBidding::query()
                ->where('product_id', $product->id)
                ->where('user_id', $user->id)
                ->where('is_won', true)
                ->first();


            $userProductBidding = UserProductBidding::query()
                ->where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($userProductBidding) {
                $userProductBidding->is_purchased = true;
                $userProductBidding->save();
            }

            $order->product_bidding_id = $productBidding->id;
            $order->price = $productBidding->bidding_price + $product->shipping_charge;
            $order->save();
        }

        if ($request->get('type') == OrderTypeEnum::StoreOrder->value) {
            $order->price = $product->price + $product->shipping_charge;
            $order->save();
        }
        $order->save();

        $payment = $this->storePaymentMethod($order, $order->price, $user, $product);
        $userTitle = "Order  Placed Successfully";
        $userMessage = "Your order {$order?->product?->name} has been successfully placed";
        NotificationToUser::sent($user, $userTitle, $userMessage, 'Notification', $order);

        return $this->jsonResponse('success', $payment ?? null, 200);
    }

//    private function biddingProducts(Order $order, Product $product, User $user): void
//    {
//        $productBidding = ProductBidding::query()
//            ->where('product_id', $product->id)
//            ->where('user_id', $user->id)
//            ->where('is_won', true)
//            ->first();
//
//        $order->product_bidding_id = $productBidding->id;
//        $order->price = $productBidding->bidding_price;
//        $order->save();
//    }
//
//    private function storeProducts(Order $order, Product $product, User $user): void
//    {
//        $order->price = $product->price;
//        $order->save();
//    }

    private function storePaymentMethod(Order $order, $paymentPrice, User $user, Product $product): null|Payment
    {
        if ($order->payment_method == PaymentMethod::ONLINE->value) {
            $payment = new Payment;
            $payment->user_id = $user->id;
            $payment->product_id = $product->id;
            $payment->order_id = $order->id;
            $payment->payment_amount = $paymentPrice * 100;
            $payment->is_coin_purchase = false;
            $payment->status = StatusEnum::PENDING;
            $payment->save();

            $order->payment_id = $payment->id;
            $order->save();
            $this->action->create($payment);

            return $payment;
        } else {
            $product->quantity = $product->quantity - 1;
            $product->save();

            if ($order->type == OrderTypeEnum::BiddingOrder->value) {
                $product->productStatusMarkAsSold();

                FirebaseHelper::updateBiddingData($product);
            }
            $order->addToOrderStatusHistory(OrderStatus::ORDER_PLACED);
        }

        return null;
    }
}
