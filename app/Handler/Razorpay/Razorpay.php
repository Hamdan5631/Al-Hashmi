<?php

namespace App\Handler\Razorpay;


use App\Actions\PaymentVerify\PaymentVerifyAction;
use App\Enums\Payment\StatusEnum;
use App\Models\Payment;
use Exception;
use Razorpay\Api\Api;

/**
 * @property Api $razorpay
 */
class Razorpay
{
    public function __construct()
    {
        $this->razorpay = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    }

    public function create(Payment $payment): Payment
    {
       $response = $this->razorpay->order->create([
            'receipt' => 'RCPT_' . $payment->id,
            'amount' => $payment->payment_amount,
            'currency' => 'INR',
            'payment_capture' => '0'
        ]);

        $payment->razorpay_order_id = $response['id'];
        $payment->razorpay_amount = $response['amount_due'];
        $payment->status = $response['status'];
        $payment->save();

        return $payment;
    }

    public function verify(string $razorpayPaymentId, Payment $payment): Payment
    {
        try {
             $response = $this->razorpay->payment
                ->fetch($razorpayPaymentId)
                ->capture(['amount' => $payment->payment_amount, 'currency' => 'INR']);
            $payment->status = StatusEnum::SUCCESS;
            $payment->log = json_encode($response);
            $payment->save();

            $verify = new PaymentVerifyAction();
            $verify->execute($payment);

            return $payment;
        } catch (Exception $e) {
            $payment->status = StatusEnum::FAILED;
            $payment->log = json_encode($e->getMessage());
            $payment->save();

            return $payment;
        }
    }

}
