<?php

namespace App\Enums;

enum NotificationStatusEnum: string
{
    case PENDING = 'pending';

    case QUEUED = 'queued';

    case PROCESSING = 'processing';

    case SENT = 'sent';

    case FAILED = 'failed';

    case READ = 'read';

    case CANCELLED = 'cancelled';
}
