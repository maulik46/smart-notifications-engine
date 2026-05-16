<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'template_id', 'channel', 'type', 'status', 'priority', 'title', 'message', 'data', 'scheduled_at', 'queued_at', 'sent_at', 'failed_at', 'read_at'])]
class Notification extends Model
{
    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'queued_at' => 'datetime',
            'sent_at' => 'datetime',
            'failed_at' => 'datetime',
            'read_at' => 'datetime',
            'email_verified_at' => 'datetime',
        ];
    }
}
