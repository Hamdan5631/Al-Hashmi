<?php

namespace App\Http\Requests\Otp;

use App\Enums\Otp\OtpTypeEnum;
use App\Enums\Users\UserStatusEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class StoreOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        return [
            'type' => Rule::in(
                OtpTypeEnum::Email->value,
                OtpTypeEnum::MOBILE->value,
            ),
            'email' => Rule::when($request->get('type') == OtpTypeEnum::Email->value, ['required']),
            'mobile_country_code' => Rule::when($request->get('type') == OtpTypeEnum::MOBILE->value, ['required']),
            'mobile' => Rule::when($request->get('type') == OtpTypeEnum::MOBILE->value, ['required']),
        ];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Exception
     */
    public function passedValidation(): void
    {
        $isRegisteredUser = request()->get('is_registered_user');
        $type = request()->get('type');

        if ($isRegisteredUser && $type == OtpTypeEnum::MOBILE->value) {
            $mobileCountryCode = request()->get('mobile_country_code');
            $mobile = request()->get('mobile');

            $user = User::query()
                ->where('mobile', $mobile)
                ->where('mobile_country_code', $mobileCountryCode)
                ->first();

            if (! $user) {
                throw ValidationException::withMessages([
                    'mobile' => ['Oops! This mobile is not registered.'],
                ]);

            }

            if ($user->status != UserStatusEnum::Active->value) {
                throw ValidationException::withMessages([
                    'mobile' => ['Your account is temporarily blocked, contact support to reactivate your account'],
                ]);
            }
        }
    }
}
