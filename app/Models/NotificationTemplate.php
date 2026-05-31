<?php

namespace App\Models;

use App\Enums\NotificationChannelEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'channel', 'subject', 'body', 'variables', 'is_active'])]
class NotificationTemplate extends Model
{
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'variables' => 'array',
            'channel' => NotificationChannelEnum::class,
        ];
    }

    public function notification(): HasMany
    {
        return $this->hasMany(Notification::class, 'template_id', 'id');
    }
}
