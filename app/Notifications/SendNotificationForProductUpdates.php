<?php

namespace App\Notifications;

use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\Exceptions\CouldNotSendNotification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

/**
 * @property Product $product
 */
class SendNotificationForProductUpdates extends Notification
{
    use Queueable;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function via(object $notifiable): array
    {
        return [FcmChannel::class];
    }

    public function viaQueues(): array
    {
        return [
            'fcm' => 'pushes',
        ];
    }

    /**
     * @throws CouldNotSendNotification
     */
    public function toFcm()
    {
        $productResource = new ProductResource($this->product);
        $productArray = $productResource->toArray(request());

         return FcmMessage::create()
        ->setTopic($this->product->id)
         ->setData(['product' => json_encode($productArray)])
        ->setApns(ApnsConfig::create()
            ->setFcmOptions(ApnsFcmOptions::create())
            ->setPayload([
                "aps" => [
                    "content-available" => 1,
                    "apns-priority" => 5,
                ]
            ])
        );
    }
}
