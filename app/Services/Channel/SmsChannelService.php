<?php

namespace App\Services\Channel;

use App\Enums\NotificationChannelEnum;
use App\Enums\NotificationStatusEnum;
use App\Jobs\ProcessNotificationJob;
use App\Models\Notification;

class SmsChannelService
{
    public function send(Notification $notification): void
    {
        
    }
}