<?php

namespace App\Http\Resources\Notification;

use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin UserNotification */
class NotificationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'message' => $this->message,
            'reference_id' => $this->reference_id,
            'reference_type' => $this->reference_type,
            'type' => $this->type,
            'read_at' => $this->read_at,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y'),
        ];
    }
}
