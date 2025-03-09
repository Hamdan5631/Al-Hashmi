<?php

namespace App\Http\Controllers\Api\V1\Otp;

use App\Actions\Otp\SendEmailOtpAction;
use App\Actions\Otp\SendMobileOtpAction;
use App\Enums\Otp\OtpTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\StoreOtpRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

class OtpSendController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(
        StoreOtpRequest     $request,
        SendEmailOtpAction  $emailOtpAction,
        SendMobileOtpAction $mobileOtpAction
    ): JsonResponse
    {
        try {
            $type = $request->get('type');

            $token = match ($type) {
                OtpTypeEnum::Email->value => $emailOtpAction->execute(collect($request->all())),
                OtpTypeEnum::MOBILE->value => $mobileOtpAction->execute(collect($request->all())),
            };

            return $this->jsonResponse('You have successfully sent the OTP.', ['token' => $token], 200);

        } catch (Exception $e) {
            return $this->jsonResponse($e->getMessage(), null, $e->getCode() ?: 400);
        }
    }

}
