<?php

namespace App\Http\Controllers\Api\V1\PurchaseCoins;

use App\Enums\Payment\StatusEnum;
use App\Handler\Razorpay\Razorpay;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseCoins\PurchaseCoinsRequest;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class PurchaseCoinsController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(
        PurchaseCoinsRequest $request,
        Razorpay $action): JsonResponse
    {
        $coins = $request->get('coins');
        $amount = $coins * 3;
        $user = User::query()->findOrFail(Auth::id());

        $payment = new Payment;
        $payment->user_id = $user->id;
        $payment->payment_amount = $amount * 100;
        $payment->is_coin_purchase = true;
        $payment->status = StatusEnum::PENDING;
        $payment->save();

        $action->create($payment);

        return $this->jsonResponse('coin purchase payment initiated', $payment, 200);
    }
}
