<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Actions\User\UserStoreAction;
use App\Actions\User\UserUpdateAction;
use App\Enums\Users\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UserController extends Controller
{

    public function index()
    {
        //
    }

    /**
     * @throws Throwable
     */
    public function store(StoreUserRequest $request, UserStoreAction $action): JsonResponse
    {
        $user = $action->execute(collect($request->all()));
        $token = $user->createToken('accessToken')->plainTextToken;

        return $this->jsonResponse('You are successfully logged in', ['user' => new UserResource($user), 'token' => $token]);
    }

    public function show($id): JsonResponse
    {
        $user = User::query()->findOrFail(Auth::id());

        return $this->jsonResponse('Success', new UserResource($user));

    }

    /**
     * @throws Throwable
     */
    public function update(UpdateUserRequest $request, UserUpdateAction $action, $id): JsonResponse
    {
        $user = User::query()->findOrFail(Auth::id());
        $action->execute(collect($request->all()), $user);

        return $this->jsonResponse('Success', new UserResource($user));
    }

    public function destroy(): JsonResponse
    {
        $user = User::query()->findOrFail(Auth::id());
        $user->tokens()->delete();
        $user->delete();

        return $this->jsonResponse('Success', new UserResource($user));
    }

    public function deleteAccount(): JsonResponse
    {
        $user = User::query()->findOrFail(Auth::id());

        $user->status = UserStatusEnum::Deleted->value;
        $user->save();

        $user->tokens()->delete();
        $user->userFcmToken()->delete();

        $user->delete();

        return $this->jsonResponse('Account deleted successfully', new UserResource($user));
    }

}
