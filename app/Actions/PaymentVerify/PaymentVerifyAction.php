<?php

namespace App\Actions\PaymentVerify;

use App\Enums\Carts\CartStatusEnum;
use App\Enums\Order\OrderTypeEnum;
use App\Enums\Products\ProductStatusEnum;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;

class PaymentVerifyAction
{
    public function execute(Payment $payment): void
    {
        if ($payment->is_coin_purchase == 1) {
            $this->coinPurchased($payment);
        }

        if ($payment->is_coin_purchase == 0) {
            $this->productPurchased($payment);
        }
    }

    private function coinPurchased(Payment $payment): void
    {
       $amount = $payment->razorpay_amount;
       $amount = $amount / 100;
       $coins = $amount / 3;

       $user = User::query()->findOrFail($payment->user_id);
       $user->coins = $user->coins + $coins;
       $user->save();
    }

    private function productPurchased(Payment $payment): void
    {
        $orders = Order::query()
            ->where('payment_id', $payment->id)
            ->get();

        foreach ($orders as $order) {
            if ($order->product_bidding_id &&
                $order->product &&
                $order->type == OrderTypeEnum::BiddingOrder->value) {
                $order->product->status = ProductStatusEnum::Sold->value;
                $order->product->save();
            }

            if ($order->type == OrderTypeEnum::StoreOrder->value &&
                $order->product_id) {
                $orderItem =  OrderItem::query()->where('order_id', $order->id)->first();
                if ($orderItem) {
                    $cart = Cart::query()->findOrFail($orderItem->cart_id);
                    $cart->status = CartStatusEnum::Accepted;
                    $cart->save();

                    $product = Product::query()->find($cart->product_id);
                    $product->quantity = $product->quantity - $cart->quantity;
                    $product->save();
                } else {
                    $order->product->quantity = $order->product->quantity - 1;
                    $order->product->save();
                }
            }

            $order->orderPlacedStatusUpdated();
        }

    }
}
