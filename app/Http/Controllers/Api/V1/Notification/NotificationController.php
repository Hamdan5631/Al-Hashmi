<?php

namespace App\Http\Controllers\Api\V1\Notification;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\NotificationCollection;
use App\Models\UserNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $pageLimit = $request->get('limit') ?? 10;

        $response = QueryBuilder::for(UserNotification::class)
            ->allowedFilters(['name'])
            ->where('user_id', Auth::id())
            ->latest()
            ->jsonPaginate($pageLimit);

        return $this->jsonResponse('Success', new NotificationCollection($response), 200);
    }
}
