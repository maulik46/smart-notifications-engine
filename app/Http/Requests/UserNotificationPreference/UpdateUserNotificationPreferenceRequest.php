<?php

namespace App\Http\Requests\UserNotificationPreference;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserNotificationPreferenceRequest extends FormRequest
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
            'user_id' => ['sometimes', Rule::exists(User::class, 'id')],
            "email_enabled" => ['sometimes', 'boolean'],
            "sms_enabled" => ['sometimes', 'boolean'],
            "push_enabled" => ['sometimes', 'boolean'],
            "marketing_enabled" => ['sometimes', 'boolean'],
            "order_updates_enabled" => ['sometimes', 'boolean'],
            "security_alert_enabled" => ['sometimes', 'boolean']
        ];
    }
}
