<?php

namespace App\Actions\Otp;

use App\Models\Otp;
use Illuminate\Support\Collection;

class VerifyOtpAction
{
    public function execute(Collection $data): string
    {
        $code = $data->get('code');

        $otp = Otp::find(decrypt($data->get('token')));

        if (! $otp || ($otp->code != $code)) {
            return Otp::CODE_NOT_SAME;
        }

        if ($otp->isExpired()) {
            return Otp::TOKEN_EXPIRED;
        }

        if ($otp->isVerified()) {
            return Otp::CODE_VERIFIED;
        }

        $otp->markAsVerified();

        return Otp::CODE_OK;
    }
}
