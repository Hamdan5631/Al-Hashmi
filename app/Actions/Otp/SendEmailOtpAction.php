<?php

namespace App\Actions\Otp;

use App\Mail\EmailNotification;
use App\Models\Otp;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendEmailOtpAction
{
    /**
     * @throws Throwable
     */
    public function execute(Collection $data): string
    {
        DB::beginTransaction();
        $code = mt_rand(1000, 9999);

        if (config('services.static_otp_code')) {
            $code = config('services.static_otp_code');
        }

        $email = $data->get('email');

        $otp = Otp::where('email', $email)->latest()->first();

        if (! $otp || $otp->isExpired() || $otp->isVerified()) {
            $otp = Otp::create([
                'email' => $email,
                'code' => $code,
            ]);
        }

        $attributes['email'] = $email;
        $attributes['code'] = $otp->code;

        try {
            Mail::send(new EmailNotification($attributes));
        } catch (Exception $exception) {
            info($exception->getMessage());
        }

        DB::commit();

        return $otp->getToken();
    }
}
