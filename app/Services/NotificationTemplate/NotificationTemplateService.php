<?php
namespace App\Services\NotificationTemplate;

use App\Models\NotificationTemplate;
use Illuminate\Support\Str;

class NotificationTemplateService
{
    public function getTemplates(bool $paginated = false, int $limit = 5, bool $active = false)
    {
        $query = NotificationTemplate::query()
            ->latest()
            ->where('is_active', $active);

        return $paginated
            ? $query->paginate($limit)
            : $query->get();
    }

    public function saveTemplate(array $data)
    {
        return NotificationTemplate::create($data);
    }

    public function updateTemplate(NotificationTemplate $template, array $data)
    {
        $template->update($data);

        return $template->fresh();
    }
}
