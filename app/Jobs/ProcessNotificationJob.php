<?php

namespace App\Jobs;

use App\Services\Notification\NotificationProcessService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNotificationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $tries = 3;

    public array $backoff = [30, 60, 120];

    /**
     * Create a new job instance.
     */
    public function __construct(public int $notificationId)
    {}

    /**
     * Execute the job.
     */
    public function handle(NotificationProcessService $processingService): void
    {
        $processingService->process($this->notificationId);
    }
}
