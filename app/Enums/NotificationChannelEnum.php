<?php

namespace App\Enums;

enum NotificationChannelEnum: string
{
    case EMAIL = 'email';

    case SMS = 'sms';

    case PUSH = 'push';

    case DATABASE = 'database';

    case WEBHOOK = 'webhook';
}
