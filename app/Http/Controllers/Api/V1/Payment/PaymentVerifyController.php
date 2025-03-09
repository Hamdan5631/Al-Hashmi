<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Enums\Payment\StatusEnum;
use App\Handler\Razorpay\Razorpay;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentVerify\PaymentVerifyRequest;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Throwable;

class PaymentVerifyController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(
        PaymentVerifyRequest $request,
        Razorpay $action): JsonResponse
    {
        $razorpayPaymentId = $request->get('razorpay_payment_id');
        $paymentId =$request->get('payment_id');
        $payment = $action->verify($razorpayPaymentId, Payment::query()->findOrFail($paymentId));

        if ($payment->status == StatusEnum::SUCCESS) {
            return $this->jsonResponse('Payment successfully verified', null, 200);
        }

        return $this->jsonResponse('Payment failed', null, 406);
    }
}
