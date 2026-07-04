<?php

namespace App\Services\Notification;

use App\Enums\NotificationChannelEnum;
use App\Enums\NotificationLogEventEnum;
use App\Enums\NotificationStatusEnum;
use App\Models\Notification;
use App\Services\Channel\ChannelResolverService;

class NotificationProcessService
{
    public function __construct(
        protected ChannelResolverService $channelResolver
    ) {
    }

    public function process(int $notificationId): void
    {
        $notification = Notification::findOrFail($notificationId);

        $notification->saveLog(
            event: NotificationLogEventEnum::PROCESSING,
            provider: NotificationChannelEnum::EMAIL,
            context: [
                'notification_id' => $notification->id,
                'template_id' => $notification->template_id,
            ],
            message: 'Notification processing started',
        );

        $notification->status = NotificationStatusEnum::PROCESSING;
        $notification->save();

        try {

            $this->channelResolver->send($notification);

            $notification->status = NotificationStatusEnum::SENT;
            $notification->sent_at = now();
            $notification->save();

            $notification->saveLog(
                event: NotificationLogEventEnum::SENT,
                provider: NotificationChannelEnum::EMAIL,
                context: [
                    'notification_id' => $notification->id,
                    'template_id' => $notification->template_id,
                ],
                message: 'Notification sent successfully',
            );

        } catch (\Throwable $e) {

            $notification->status = NotificationStatusEnum::FAILED;
            $notification->failed_at = now();
            $notification->save();

            $notification->saveLog(
                event: NotificationLogEventEnum::FAILED,
                provider: NotificationChannelEnum::EMAIL,
                context: [
                    'notification_id' => $notification->id,
                    'template_id' => $notification->template_id,
                ],
                message: 'Notification failed to send: ' . $e->getMessage(),
            );

            throw $e;
        }
    }
}