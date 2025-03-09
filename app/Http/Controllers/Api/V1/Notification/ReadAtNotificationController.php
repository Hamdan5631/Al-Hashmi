<?php

namespace App\Http\Controllers\Api\V1\Notification;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReadAtNotificationController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        $userNotification = UserNotification::query()->where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (!$userNotification) {
            return $this->jsonResponse('Notification not found', null, 422);
        }

        if (!$userNotification->read_at) {
            $userNotification->read_at = Carbon::now()->format('Y-m-d H:i:s');
            $userNotification->save();
        }

        return $this->jsonResponse('Success', null, 200);
    }
}
