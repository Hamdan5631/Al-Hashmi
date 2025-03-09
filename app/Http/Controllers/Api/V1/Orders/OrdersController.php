<?php

namespace App\Http\Controllers\Api\V1\Orders;

use App\Enums\Order\CancellationRequest;
use App\Enums\Order\OrderStatus;
use App\Enums\UserNotifications\UserNotificationMsg;
use App\Helpers\UserNotifications\NotificationToUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderCollection;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class OrdersController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $pageLimit = $request->get('limit') ?? 10;

        $response = QueryBuilder::for(Order::class)
            ->allowedFilters(['name'])
            ->where('status', '!=', OrderStatus::ORDER_PENDING->value)
            ->where('user_id', Auth::id())
            ->latest()
            ->jsonPaginate($pageLimit);

        return $this->jsonResponse('Success', new OrderCollection($response), 200);
    }

    public function show($id): JsonResponse
    {
        return $this->jsonResponse(
            'Success',
            new OrderResource(Order::query()->where('user_id', Auth::id())->find($id)),
            200
        );
    }

    public function returnOrder($id): JsonResponse
    {
        $order = Order::query()->find($id);
        $order->status = OrderStatus::REQUESTED_FOR_RETURN->value;
        $order->save();
        $order->orderStatusHistories()->create(['order_id' => $id, 'status' => OrderStatus::REQUESTED_FOR_RETURN->value]);
        $userTitle = UserNotificationMsg::ReturnOrderTitle->value;
        $userMessage = UserNotificationMsg::ReturnOrderDescription->value;
        NotificationToUser::sent(Auth::user(), $userTitle, $userMessage, 'Order', $order);

        return $this->jsonResponse('Requested for return successfully', new OrderResource($order), 200);
    }

    public function cancelOrder(Request $request): JsonResponse
    {
        $order = Order::query()->find($request->get('order_id'));
        $order->status = OrderStatus::CANCELLED->value;
        $order->save();

        $order->orderStatusHistories()->create([
            'order_id' => $request->get('order_id'),
            'status' => OrderStatus::CANCELLED->value
        ]);

        $order->orderCancellationRequest()->create([
            'order_id' => $request->get('order_id'),
            'user_id' => Auth::id(),
            'payment_id' => $order?->payment_id ?? null,
            'reason' => $request->get('reason'),
            'status' => CancellationRequest::Pending->value
        ]);
        $userTitle = UserNotificationMsg::CancelOrderTitle->value;
        $userMessage = UserNotificationMsg::CancelOrderDescription->value;
        NotificationToUser::sent(Auth::user(), $userTitle, $userMessage, 'Notification', $order);

        return $this->jsonResponse('Order cancelled successfully', new OrderResource($order), 200);
    }
}
