<?php

namespace App\Models;

use App\Enums\NotificationChannelEnum;
use App\Enums\NotificationLogEventEnum;
use App\Enums\NotificationPriorityEnum;
use App\Enums\NotificationStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['uuid', 'user_id', 'template_id', 'status', 'priority', 'title', 'message', 'data', 'scheduled_at', 'queued_at', 'sent_at', 'failed_at', 'read_at'])]
class Notification extends Model
{
    protected function casts(): array
    {
        return [
            'status' => NotificationStatusEnum::class,
            'priority' => NotificationPriorityEnum::class,
            'scheduled_at' => 'datetime',
            'queued_at' => 'datetime',
            'sent_at' => 'datetime',
            'failed_at' => 'datetime',
            'read_at' => 'datetime',
            'data' => 'object'
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(NotificationTemplate::class, 'template_id', 'id');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(NotificationLog::class, 'notification_id', 'id');
    }

    public function saveLog(
        NotificationLogEventEnum $event,
        NotificationChannelEnum $provider = NotificationChannelEnum::EMAIL,
        array $context = [],
        ?string $message = null,
    ): void {

        $this->logs()->create([
            'event' => $event,
            'provider' => $provider,
            'attempt' => 1,
            'message' => $message,
            'context' => $context,
            'processed_at' => now(),
        ]);
    }
}
