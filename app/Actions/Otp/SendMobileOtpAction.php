<?php

namespace App\Actions\Otp;

use App\Handler\Msg91\Msg91SmsProvider;
use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class SendMobileOtpAction extends Controller
{
    /**
     * @throws Throwable
     */

    /**
     * @throws Throwable
     * @throws GuzzleException
     */
    public function execute(Collection $data): string
    {
        DB::beginTransaction();

        try {
            $mobile = $data->get('mobile');
            $mobileCountryCode = $data->get('mobile_country_code');
            $phone = $mobileCountryCode . $mobile;


            $code = mt_rand(1000, 9999);

            $otp = Otp::query()
                ->where('mobile_country_code', $mobileCountryCode)
                ->where('mobile', $mobile)
                ->latest()
                ->first();

            if (!$otp || $otp->isExpired() || $otp->isVerified()) {
                $otp = Otp::query()->create([
                    'mobile' => $mobile,
                    'mobile_country_code' => $mobileCountryCode,
                    'code' => $code,
                ]);

                $twilioSmsProvider = new Msg91SmsProvider();
                $twilioSmsProvider->send($phone, $code);
            } else {
                throw new Exception('OTP is still valid or already verified. No new OTP sent.', 400);
            }

            DB::commit();

            return $otp->getToken();

        } catch (Exception $e) {
            DB::rollBack();
                throw $e;
        }
    }

}
