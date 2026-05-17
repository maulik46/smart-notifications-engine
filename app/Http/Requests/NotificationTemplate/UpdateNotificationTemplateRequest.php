<?php

namespace App\Http\Requests\NotificationTemplate;

use App\Enums\NotificationChannelEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateNotificationTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'slug' => [
                'sometimes',
                'alpha_dash',
                'unique:notification_templates,slug,' . $this->template->id,
            ],
            'channel' => [
                'sometimes',
                new Enum(NotificationChannelEnum::class),
            ],
            'subject' => ['sometimes', 'string'],
            'body' => ['sometimes', 'string'],
            'variables' => ['sometimes', 'array'],
            'variables.*' => ['string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
