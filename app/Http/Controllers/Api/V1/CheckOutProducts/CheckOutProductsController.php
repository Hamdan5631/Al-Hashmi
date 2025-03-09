<?php

namespace App\Http\Controllers\Api\V1\CheckOutProducts;

use App\Enums\Carts\CartStatusEnum;
use App\Enums\Order\OrderStatus;
use App\Enums\Order\OrderTypeEnum;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Payment\StatusEnum;
use App\Handler\Razorpay\Razorpay;
use App\Helpers\UserNotifications\NotificationToUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOutProducts\CheckOutProductStoreRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Throwable;

/**
 * @property Razorpay $action
 */
class CheckOutProductsController extends Controller
{
    public function __construct(Razorpay $action)
    {
        $this->action = $action;
    }
    /**
     * @throws Throwable
     */
    public function __invoke(CheckOutProductStoreRequest $request): JsonResponse
    {
        $user = User::query()->findOrFail(Auth::id());
        $address = Address::query()->findOrFail($request->get('address_id'));
        $paymentMethod = $request->get('payment_method');
        $cartIds = array_filter($request->get('cart_ids'));
        $orderIds = [];

        $carts = Cart::query()
            ->where('user_id', Auth::id())
            ->whereIn('id', $cartIds)
            ->where('status', CartStatusEnum::Pending)
            ->get();

        foreach ($carts as $cart) {
            $product = Product::query()->findOrFail($cart->product_id);
            $orderId = $this->storeOrder($user, $cart, $product, $address, $paymentMethod);
            $orderIds[] = $orderId;
        }

        $products = Product::query()
            ->whereIn('id', $request->get('product_ids'))
            ->get();

        $itemPrice = $carts->sum(function ($cartItem) use ($products) {
            $product = $products->firstWhere('id', $cartItem->product_id);
            return $product ? $product->price * $cartItem->quantity : 0;
        });

        $shippingCharge = $products->sum('shipping_charge');
        $total = $itemPrice + $shippingCharge;

        $payment = $this->storePaymentMethod($paymentMethod, $total, $user, $carts, $orderIds);

        return $this->jsonResponse(
            message: 'Success',
            data: $payment,
        );

    }

    private function storePaymentMethod(
        string $paymentMethod, $paymentPrice,
        User $user,
        Collection|array $carts,
        array $orderIds): ?Payment
    {
        if ($paymentMethod == PaymentMethod::ONLINE->value) {
            $payment = new Payment;
            $payment->user_id = $user->id;
            $payment->payment_amount = $paymentPrice * 100;
            $payment->is_coin_purchase = false;
            $payment->status = StatusEnum::PENDING;
            $payment->save();

            Order::query()->whereIn('id', $orderIds)->update([
                'payment_id' => $payment->id,
            ]);

            $this->action->create($payment);

            return $payment;
        } else {

            Order::query()->whereIn('id', $orderIds)->update([
                'status' => OrderStatus::ORDER_PLACED,
            ]);

            foreach ($carts as $cart) {
                $cart->status = CartStatusEnum::Accepted;
                $cart->save();

                $product = Product::query()->find($cart->product_id);
                $product->quantity = $product->quantity - $cart->quantity;
                $product->save();
            }
        }

        return null;
    }

    private function storeOrder(User $user, Cart $cart, Product $product, Address $address, string $paymentMethod): int
    {
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
        $order->type = OrderTypeEnum::StoreOrder->value;

        if ($paymentMethod == PaymentMethod::CASH_ON_DELIVERY->value) {
            $order->status = OrderStatus::ORDER_PLACED;
        }

        if ($paymentMethod == PaymentMethod::ONLINE->value) {
            $order->status = OrderStatus::ORDER_PENDING;
        }

        $deliveryDay = Carbon::now()->addDays($product->estimated_delivery)->format('Y-m-d');

        $order->delivery_date = $deliveryDay;
        $order->price = $product->price + $product->shipping_charge;
        $order->save();

        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->cart_id = $cart->id;
        $orderItem->save();

        $userTitle = "Order  Placed Successfully";
        $userMessage = "Your order {$order?->product?->name} has been successfully placed";
        NotificationToUser::sent($user, $userTitle, $userMessage, 'Notification', $order);

        return $order->id;
    }
}
