<?php

namespace App\Actions\User;

use App\Enums\UserNotifications\UserNotificationMsg;
use App\Enums\Users\UserStatusEnum;
use App\Models\User;
use App\Models\UserFcmToken;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

class UserStoreAction
{
    /**
     * @throws Throwable
     */
    public function execute(Collection $data): User
    {
        DB::beginTransaction();

        $user = new User();
        $user->name = $data->get('name');
        $user->email = $data->get('email');
        $user->mobile_country_code = $data->get('mobile_country_code');
        $user->mobile = $data->get('mobile');
        $user->password = Hash::make($data->get('password'));
        $user->status = UserStatusEnum::Active;
        $user->save();

        $userTitle = UserNotificationMsg::WelcomeMessageTitle->value;
        $userMessage = UserNotificationMsg::WelcomeMessageDescription->value;
        Mail::raw($userMessage, function ($message) use ($user, $userTitle) {
            $message->to($user->email)
                ->subject($userTitle);
        });

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

        DB::commit();

        return $user;
    }
}
