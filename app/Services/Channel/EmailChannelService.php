<?php

namespace App\Services\Channel;

use App\Mail\NotificationMail;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;

class EmailChannelService
{
    public function send(Notification $notification): void
    {
        Mail::to($notification->user->email)
            ->send(new NotificationMail($notification));
    }
}
