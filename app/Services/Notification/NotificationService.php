<?php

namespace App\Services\Notification;

use App\Models\Notification;
use App\Models\NotificationTemplate;
use App\Models\User;
use Illuminate\Support\Str;

class NotificationService
{
    public function __construct(protected TemplateParserService $templateParserService)
    {
        
    }

    public function saveNotification(array $data)
    {
        $parsedData = $this->templateParserService->parseData($data['template_id'], $data['data']);
        
        return Notification::create([
            'uuid' => Str::uuid(),
            'user_id' => $data['user_id'],
            'template_id' => $data['template_id'],
            'title' => $parsedData['subject'],
            'message' => $parsedData['body'],
            'data' => $data['data'],
        ]);

    }
}
