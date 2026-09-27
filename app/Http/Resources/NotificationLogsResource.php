<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationLogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'notification_id' => $this['notification_id'],
            'event' => $this['event'],
            'provider' => $this['provider'],
            'message' => $this['message'],
            'processed_at' => $this['processed_at'],
        ];
    }
}
