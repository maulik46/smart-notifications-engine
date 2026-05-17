<?php

namespace App\Http\Requests\NotificationTemplate;

use App\Enums\NotificationChannelEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreNotificationTemplateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'unique:notification_templates,slug'],
            'channel' => ['required', 'string', new Enum(NotificationChannelEnum::class)],
            'subject' => ['required', 'string'],
            'body' => ['required', 'string'],
            'variables' => ['nullable', 'array'],
            'variables.*' => ['required', 'string'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
