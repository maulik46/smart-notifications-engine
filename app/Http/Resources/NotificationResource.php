<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'user' => $this->user,
            'template' => $this->template,
            'status' => $this->status,
            'priority' => $this->priority,
            'title' => $this->title,
            'message' => $this->message,
            'data' => $this->data,
            'scheduled_at' => $this->scheduled_at,
            'queued_at' => $this->queued_at,
            'sent_at' => $this->sent_at,
            'failed_at' => $this->failed_at,
            'read_at' => $this->read_at,
            'created_at' => $this->created_at,
        ];
    }
}
