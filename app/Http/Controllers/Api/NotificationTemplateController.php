<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationTemplate\StoreNotificationTemplateRequest;
use App\Http\Requests\NotificationTemplate\UpdateNotificationTemplateRequest;
use App\Http\Resources\NotificationTemplateResource;
use App\Models\NotificationTemplate;
use App\Services\NotificationTemplate\NotificationTemplateService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NotificationTemplateController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected NotificationTemplateService $notificationTemplateService)
    {
        
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $data = $this->notificationTemplateService->getTemplates(
            paginated: true, 
            limit: $request->integer('limit', 10),
            active: $request->boolean('active')
        );

        return NotificationTemplateResource::collection($data);
    }

    public function store(StoreNotificationTemplateRequest $request): JsonResponse
    {
        $data = $this->notificationTemplateService->saveTemplate($request->validated());

        return $this->successResponse(new NotificationTemplateResource($data), 'Template created successfully', 201);
    }

    public function show(NotificationTemplate $template)
    {
        return $this->successResponse(new NotificationTemplateResource($template));
    }

    public function update(UpdateNotificationTemplateRequest $request, NotificationTemplate $template)
    {
        $data = $this->notificationTemplateService->updateTemplate($template, $request->validated());

        return $this->successResponse(new NotificationTemplateResource($data), 'Template updated successfully', 201);
    }

    public function delete(NotificationTemplate $template)
    {
        $template->delete();

        return $this->successResponse([], 'Templated deleted successfully!');
    }

}
