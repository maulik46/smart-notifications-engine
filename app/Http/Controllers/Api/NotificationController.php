<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\StoreNotificationRequest;
use App\Services\Notification\NotificationService;
use App\Traits\ApiResponseTrait;

class NotificationController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected NotificationService $notificationService)
    {
        
    }

    public function store(StoreNotificationRequest $request)
    {
        $data = $this->notificationService->saveNotification($request->validated());

        return $this->successResponse($data, 'Notification created successfully!', 201);
    }
}
