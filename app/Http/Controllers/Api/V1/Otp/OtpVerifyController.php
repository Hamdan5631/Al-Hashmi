<?php

namespace App\Http\Controllers\Api\V1\Otp;

use App\Actions\Otp\VerifyOtpAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\VerifyOtpRequest;
use App\Models\Otp;
use Illuminate\Http\JsonResponse;
use Throwable;

class OtpVerifyController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(
        VerifyOtpRequest $request,
        VerifyOtpAction $verifyOtpAction): JsonResponse
    {
        $response = $verifyOtpAction->execute(collect($request->all()));

        if ($response == Otp::CODE_NOT_SAME) {
            return $this->error('Invalid Code', ['code' => ['Invalid Code ']], 422);
        }

        if ($response == Otp::TOKEN_EXPIRED) {
            return $this->error('OTP Expired ', ['code' => ['OTP Expired  ']], 422);
        }

        if ($response == Otp::CODE_VERIFIED) {
            return $this->error('OTP Already Verified ', ['code' => ['OTP Already Verified']], 422);
        }

        return $this->jsonResponse('OTP successfully verified', null, 200);
    }
}
