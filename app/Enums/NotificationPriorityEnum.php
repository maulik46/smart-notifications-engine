<?php

namespace App\Enums;

enum NotificationPriorityEnum: string
{
    case LOW = 'low';

    case MEDIUM = 'medium';

    case HIGH = 'high';

    case CRITICAL = 'critical';
}
