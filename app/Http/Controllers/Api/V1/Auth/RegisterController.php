<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Actions\User\UserStoreAction;
use App\Enums\UserNotifications\UserNotificationMsg;
use App\Helpers\UserNotifications\NotificationToUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Throwable;

class RegisterController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(StoreUserRequest $request, UserStoreAction $action): JsonResponse
    {
        $user = $action->execute(collect($request->all()));
        $token = $user->createToken('accessToken')->plainTextToken;
        $userTitle = UserNotificationMsg::WelcomeMessageTitle->value;
        $userMessage = UserNotificationMsg::WelcomeMessageDescription->value;
        NotificationToUser::sent($user, $userTitle, $userMessage, null, null);

        return $this->jsonResponse('You are successfully logged in', ['user' => new UserResource($user), 'token' => $token]);
    }
}
