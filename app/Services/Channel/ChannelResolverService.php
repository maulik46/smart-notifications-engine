<?php

namespace App\Services\Channel;

use App\Enums\NotificationChannelEnum;
use App\Models\Notification;

class ChannelResolverService
{
    public function __construct(
        protected EmailChannelService $emailChannelService,
        protected SmsChannelService $smsChannelService,
        protected PushChannelService $pushChannelService
    ) {
    }

    public function send(Notification $notification): void
    {
        match ($notification->template->channel) {
            NotificationChannelEnum::EMAIL => $this->emailChannelService->send($notification),

            NotificationChannelEnum::SMS => $this->smsChannelService->send($notification),

            NotificationChannelEnum::PUSH => $this->pushChannelService->send($notification),
        };
    }
}