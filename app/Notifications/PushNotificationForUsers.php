<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

/**
 * @property array $attributes
 */
class PushNotificationForUsers extends Notification
{
    use Queueable;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function via(object $notifiable): array
    {
        return [FcmChannel::class];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData([
                'data' => json_encode($this->attributes),
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
            ])
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
            )
            ->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(
                        ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')
                    )
                    ->setPayload([
                        'aps' => [
                            'alert' => [
                                'title' => $this->attributes['title'] ?? 'Default Title',
                                'body' => $this->attributes['message'] ?? 'Default Message',
                            ],
                            'sound' => 'default',
                            'badge' => 1,
                            'content-available' => 1,
                        ],
                    ])
            );
    }


}
