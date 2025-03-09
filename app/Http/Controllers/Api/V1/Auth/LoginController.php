<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Enums\Login\LoginTypeEnum;
use App\Enums\Users\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\UserFcmToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $mobileCountryCode = $request->get('mobile_country_code');
        $mobile = $request->get('mobile');
        $password = $request->get('password');
        $type = $request->get('type');

        $user = User::query()
            ->where('mobile_country_code', $mobileCountryCode)
            ->where('mobile', $mobile)
            ->first();

        if (!$user) {
            return $this->error('Invalid Credential',
                ['mobile' => ['This Mobile number is not registered.']], 422);
        }

        if ($user->status != UserStatusEnum::Active->value) {
            return $this->error('Your account is temporarily blocked, contact support to reactivate your account',
                null, 401);
        }
        if ($type == LoginTypeEnum::PASSWORD->value) {
            if (Hash::check($password, $user->password)) {
                $this->storeUserDevice($user, collect($request));
                $token = $user->createToken('accessToken')->plainTextToken;

                return $this->jsonResponse('You are successfully logged in', ['user' => new UserResource($user), 'token' => $token]);

            }
            return $this->error('Invalid Credential', ['password' => ['invalid password']], 422);
        }

        $this->storeUserDevice($user, collect($request));

        $token = $user->createToken('accessToken')->plainTextToken;

        return $this->jsonResponse('You are successfully logged in', ['user' => new UserResource($user), 'token' => $token]);

    }

    private function storeUserDevice(User $user, Collection $data): void
    {
        $userDevice = UserFcmToken::query()
            ->where('user_id', $user->id)
            ->first();

        if (!$userDevice) {
            $userDevice = new UserFcmToken();
        }

        $userDevice->user_id = $user->id;
        $userDevice->device_type = $data->get('device_type');
        $userDevice->device_id = $data->get('device_id');
        $userDevice->fcm_token = $data->get('fcm_token');
        $userDevice->is_loggedout = false;
        $userDevice->ip = $data->get('ip');
        $userDevice->save();
    }
}
