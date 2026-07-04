<?php

namespace App\Services\Notification;

use App\Models\Notification;
use Illuminate\Support\Str;

class NotificationService
{
    public function __construct(protected TemplateParserService $templateParserService)
    {
        
    }

    public function getNotifications()
    {
        return Notification::query()->latest()->get();
    }

    public function saveNotification(array $data)
    {
        $parsedData = $this->templateParserService->parseData($data['template_id'], $data['data']);

        $notification = Notification::create([
            'uuid' => Str::uuid(),
            'user_id' => $data['user_id'],
            'template_id' => $data['template_id'],
            'title' => $parsedData['subject'],
            'message' => $parsedData['body'],
            'data' => $data['data'],
            'scheduled_at' => $data['scheduled_at'] ?? null,
        ]);

        $notification->logs()->create([
            'status' => 'pending',
            'provider' => $notification->template->channel,
            'response' => json_encode($notification),
        ]);

        return $notification;
    }
}
