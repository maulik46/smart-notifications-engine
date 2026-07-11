<?php

namespace App\Services\Notification;

use App\Enums\NotificationLogEventEnum;
use App\Enums\NotificationStatusEnum;
use App\Models\Notification;
use App\Services\Channel\ChannelResolverService;
use Illuminate\Support\Facades\DB;

class NotificationProcessService
{
    public function __construct(
        protected ChannelResolverService $channelResolver
    ) {
    }

    public function process(int $notificationId): void
    {
        DB::transaction(function () use ($notificationId) {
            $notification = Notification::findOrFail($notificationId);
    
            if ($notification->status === NotificationStatusEnum::SENT) {
                return;
            }
    
            $notification->saveLog(
                event: NotificationLogEventEnum::PROCESSING,
                provider: $notification->template->channel,
                context: [
                    'notification_id' => $notification->id,
                    'template_id' => $notification->template_id,
                ],
                message: 'Notification processing started',
            );
    
            $notification->status = NotificationStatusEnum::PROCESSING;
            $notification->read_at = now();
            $notification->save();
    
            try {
    
                $this->channelResolver->send($notification);
    
                $notification->status = NotificationStatusEnum::SENT;
                $notification->sent_at = now();
                $notification->save();
    
                $notification->saveLog(
                    event: NotificationLogEventEnum::SENT,
                    provider: $notification->template->channel,
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
                    provider: $notification->template->channel,
                    context: [
                        'notification_id' => $notification->id,
                        'template_id' => $notification->template_id,
                    ],
                    message: 'Notification failed to send: ' . $e->getMessage(),
                );
    
                throw $e;
            }
        });
    }
}