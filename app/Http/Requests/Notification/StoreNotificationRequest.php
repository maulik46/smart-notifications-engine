<?php

namespace App\Http\Requests\Notification;

use App\Models\NotificationTemplate;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'user_id' => 'Invalid user',
            'templated_id' => 'Invalid template',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', Rule::exists(User::class, 'id')],
            'template_id' => ['required', Rule::exists(NotificationTemplate::class, 'id')],	
            'data' => ['required'],
        ];
    }
}
