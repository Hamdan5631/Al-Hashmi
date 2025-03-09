<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = User::query()->findOrFail(Auth::id());

        $user->userFcmToken()?->delete();

        $request?->user()?->currentAccessToken()?->delete();

        return $this->jsonResponse('success');
    }
}
