<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Enums\Users\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest\ForgotPasswordRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\UserFcmToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function __invoke(ForgotPasswordRequest $request): JsonResponse
    {
        $mobileCountryCode = $request->get('mobile_country_code');
        $mobile = $request->get('mobile');
        $password = $request->get('password');

        $user = User::query()
            ->where('mobile_country_code', $mobileCountryCode)
            ->where('mobile', $mobile)
            ->first();

        if (! $user) {
            return $this->error('Invalid Credential',
                ['mobile' => ['This Mobile number is not registered.']], 422);
        }

        if ($user->status != UserStatusEnum::Active->value) {
            return $this->error('Your account is temporarily blocked, contact support to reactivate your account',
                null, 401);
        }

        $user->password = Hash::make($password);
        $user->save();

        $token = $user->createToken('accessToken')->plainTextToken;
        $userDevice = UserFcmToken::query()
            ->where('user_id', $user->id)
            ->first();

        if (! $userDevice) {
            $userDevice = new UserFcmToken;
        }

        $userDevice->user_id = $user->id;
        $userDevice->device_type = $request->get('device_type');
        $userDevice->device_id = $request->get('device_id');
        $userDevice->fcm_token = $request->get('fcm_token');
        $userDevice->is_loggedout = false;
        $userDevice->ip = $request->getClientIp();
        $userDevice->save();

        return $this->jsonResponse('You are successfully logged in', ['user' => new UserResource($user), 'token' => $token]);
   }
}
