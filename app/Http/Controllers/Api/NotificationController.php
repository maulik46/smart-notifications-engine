<?php

namespace App\Http\Controllers\Api;

use App\Enums\NotificationStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\StoreNotificationRequest;
use App\Http\Requests\Notification\UpdateNotificationStatusRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Services\Notification\NotificationService;
use App\Traits\ApiResponseTrait;

class NotificationController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected NotificationService $notificationService)
    {
        
    }

    public function index()
    {
        $data = $this->notificationService->getNotifications();

        return $this->successResponse($data, 'Notifications retrieved successfully!');
    }

    public function store(StoreNotificationRequest $request)
    {
        $data = $this->notificationService->saveNotification($request->validated());

        return $this->successResponse($data, 'Notification created successfully!', 201);
    }

    public function show(Notification $notification)
    {
        $notification->load('template', 'user');

        return $this->successResponse(new NotificationResource($notification));
    }

    public function updateStatus(UpdateNotificationStatusRequest $request, Notification $notification)
    {
        $notification->status = $request->validated('status');
        if(NotificationStatusEnum::READ->value === $request->validated('status')) {
            $notification->read_at = now();
        }

        $notification->save();

        return $this->successResponse(new NotificationResource($notification), 'Notification status updated successfully!');
    }

    public function statistics()
    {
        $statistics = Notification::query()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        return $this->successResponse($statistics, 'Notification statistics retrieved successfully!');
    }
}
