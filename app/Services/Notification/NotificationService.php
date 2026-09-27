<?php

namespace App\Services\Notification;

use App\Enums\NotificationLogEventEnum;
use App\Enums\NotificationStatusEnum;
use App\Jobs\ProcessNotificationJob;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationService
{
    public function __construct(protected TemplateParserService $templateParserService) {}

    public function getNotifications(): array
    {
        return Notification::query()->latest()->get()->toArray();
    }

    public function saveNotification(array $data)
    {
        DB::transaction(function () use ($data) {
            $parsedData = $this->templateParserService->parseData($data['template_id'], $data['data']);

            $notification = Notification::create([
                'uuid' => Str::uuid(),
                'user_id' => $data['user_id'],
                'template_id' => $data['template_id'],
                'title' => $parsedData['subject'],
                'message' => $parsedData['body'],
                'data' => $data['data'],
                'scheduled_at' => $data['scheduled_at'] ?? null,
                'queued_at' => now(),
            ]);

            $notification->saveLog(
                event: NotificationLogEventEnum::QUEUED,
                provider: $notification->template->channel,
                context: [
                    'notification_id' => $notification->id,
                    'template_id' => $notification->template_id,
                ],
                message: 'Notification created successfully',
            );

            if (isset($data['scheduled_at']) && $data['scheduled_at']) {
                ProcessNotificationJob::dispatch($notification->id)->delay($notification->scheduled_at);
            } else {
                ProcessNotificationJob::dispatch($notification->id);
            }

            return $notification;
        });
    }

    public function retryNotification(Notification $notification)
    {
        if ($notification->status !== NotificationStatusEnum::FAILED) {
            throw new \Exception('Only failed notifications can be retried.');
        }

        DB::transaction(function () use ($notification) {
            $notification->update([
                'status' => NotificationStatusEnum::PENDING,
                'failed_at' => null,
            ]);

            $notification->saveLog(
                event: NotificationLogEventEnum::RETRY,
                provider: $notification->template->channel,
                message: 'Notification manually queued for retry.'
            );

            ProcessNotificationJob::dispatch($notification->id);
        });
    }
}
