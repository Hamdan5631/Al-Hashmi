<?php

namespace App\Http\Requests\PaymentVerify;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PaymentVerifyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        return [
            'razorpay_payment_id' => 'required',
            'payment_id' => 'required',
        ];
    }
}
