<?php

namespace App\Enums;

enum NotificationLogEventEnum: string
{
    case QUEUED = 'queued';

    case PROCESSING = 'processing';

    case SENDING = 'sending';

    case SENT = 'sent';

    case FAILED = 'failed';

    case RETRY = 'retry';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
