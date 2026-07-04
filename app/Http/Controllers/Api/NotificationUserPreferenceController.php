<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserNotificationPreference\StoreUserNotificationPreferenceRequest;
use App\Http\Requests\UserNotificationPreference\UpdateUserNotificationPreferenceRequest;
use App\Models\UserNotificationPreference;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class NotificationUserPreferenceController extends Controller
{
    use ApiResponseTrait;

    public function index(int $user_id)
    {
        $data = UserNotificationPreference::where('user_id', $user_id)->first();

        return $this->successResponse($data, 'User preferences retrieved successfully!');
    }

    public function store(StoreUserNotificationPreferenceRequest $request)
    {
        $data = UserNotificationPreference::create($request->validated());

        return $this->successResponse($data, 'User preference created successfully!', 201);
    }

    public function update(UpdateUserNotificationPreferenceRequest $request, int $user_id)
    {
        $data = UserNotificationPreference::where('user_id', $user_id)->firstOrFail();
        $data->update($request->validated());

        return $this->successResponse($data, 'User preference updated successfully!');
    }

    public function delete(int $user_id)
    {
        $data = UserNotificationPreference::where('user_id', $user_id)->firstOrFail();
        $data->delete();

        return $this->successResponse(null, 'User preference deleted successfully!');
    }
}
