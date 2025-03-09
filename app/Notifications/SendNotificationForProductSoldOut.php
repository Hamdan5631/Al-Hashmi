<?php

namespace App\Notifications;

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
class SendNotificationForProductSoldOut extends Notification
{
    use Queueable;

    protected Product $product;

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
    public function toFcm($notifiable)
    {
        $topic = 'product_' . $this->product->id;

        return FcmMessage::create()
            ->setTopic($topic)
            ->setData([
                'is_sold_out' => 'yes',
            ])
            ->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create())
                    ->setPayload([
                        'aps' => [
                            'alert' => [
                                'title' => 'Product Sold Out',
                                'body' => 'The product ' . $this->product->name . ' is now sold out.',
                            ],
                            'content-available' => 1,
                            'apns-priority' => 10,
                        ],
                    ])
            );
    }

}

