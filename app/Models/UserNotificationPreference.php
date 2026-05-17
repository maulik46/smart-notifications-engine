<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'email_enabled', 'sms_enabled', 'push_enabled', 'marketing_enabled', 'order_updates_enabled', 'security_alert_enabled'])]
class UserNotificationPreference extends Model
{
    protected function casts(): array
    {
        return [
            'email_enabled' => 'boolean',
            'sms_enabled' => 'boolean',
            'push_enabled' => 'boolean',
            'marketing_enabled' => 'boolean',
            'order_updates_enabled' => 'boolean',
            'security_alert_enabled' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
