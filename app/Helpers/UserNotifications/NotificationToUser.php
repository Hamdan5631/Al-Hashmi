<?php

namespace App\Helpers\UserNotifications;

use App\Models\User;
use App\Models\UserFcmToken;
use App\Models\UserNotification;
use App\Notifications\PushNotificationForUsers;
use App\Notifications\UserPropertyAddedPushNotification;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class NotificationToUser
{
    public static function sent(?User $user, ?string $title, ?string $message, ?string $type, ?Model $model): void
    {
        if (!$user) {
            return;
        }

        $userNotification = new UserNotification();
        $userNotification->user_id = $user->id;
        $userNotification->title = $title;
        $userNotification->message = $message;
        $userNotification->type = $type;
        $userNotification->save();

        $model?->userNotification()?->save($userNotification); 

        $attributes['title'] = $title;
        $attributes['message'] = $message;
        $attributes['redirection_id'] = $userNotification?->reference_id;
        $attributes['redirection_type'] = $userNotification?->type ?? $userNotification->reference_type;

        $userFcmToken = UserFcmToken::query()
            ->where('user_id', $user->id)
            ->where('is_loggedout', 0)
            ->get();

        foreach ($userFcmToken as $token) {
            try {
                Notification::route('fcm', $token->fcm_token)
                    ->notify(new PushNotificationForUsers($attributes));
            } catch (Exception $exception) {
                info($exception->getMessage());
            }
        }

    }
}
