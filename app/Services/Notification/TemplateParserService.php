<?php

namespace App\Services\Notification;

use App\Models\NotificationTemplate;

class TemplateParserService
{
    public function parseData(int $templateId, array $data): array
    {
        $template = NotificationTemplate::findOrFail($templateId);
        $body = $template->body;
        $subject = $template->subject;

        if (! empty($data)) {
            foreach ($data as $key => $value) {
                $bodyValueReplaced = str_replace($key, $value, $body);
                $body = str_replace(['{{ ', ' }}', '{{', '}}'], '', $bodyValueReplaced);

                $subjectValueReplaced = str_replace($key, $value, $subject);
                $subject = str_replace(['{{ ', ' }}', '{{', '}}'], '', $subjectValueReplaced);
            }
        }

        return [
            'subject' => $subject,
            'body' => $body,
        ];
    }
}
