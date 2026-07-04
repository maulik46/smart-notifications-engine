<?php

namespace App\Models;

use App\Enums\NotificationChannelEnum;
use App\Enums\NotificationLogEventEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['notification_id', 'event', 'provider', 'provider_message_id',	'attempt', 'context', 'message', 'processed_at'])]
class NotificationLog extends Model
{
    protected function casts(): array
    {
        return [
            'processed_at' => 'datetime',
            'context' => 'object',
            'event' => NotificationLogEventEnum::class,
            'provider' => NotificationChannelEnum::class,
        ];
    }

    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }
}
