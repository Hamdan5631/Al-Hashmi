<?php

namespace App\Http\Controllers\Api\V1\Transactions;


use App\Enums\Payment\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Payment\PaymentCollection;
use App\Models\Payment;
use App\Notifications\TopicPushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Kreait\Firebase\Exception\DatabaseException;
use Kreait\Firebase\Factory;
use Spatie\QueryBuilder\QueryBuilder;


class TransactionsController extends Controller
{
    public function __invoke(Request $request): PaymentCollection
    {
        $pageLimit = $request->get('limit') ?? 10;

        $response = QueryBuilder::for(Payment::class)
            ->where('user_id', Auth::id())
            ->where('status', StatusEnum::SUCCESS)
            ->where('is_coin_purchase', true)
            ->latest()
            ->jsonPaginate($pageLimit);

        return new PaymentCollection($response);
    }

}
