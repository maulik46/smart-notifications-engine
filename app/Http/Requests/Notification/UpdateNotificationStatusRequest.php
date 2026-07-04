<?php

namespace App\Http\Requests\Notification;

use App\Enums\NotificationStatusEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNotificationStatusRequest extends FormRequest
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
            'status' => [
                'required', 
                'string', 
                Rule::in(
                    NotificationStatusEnum::PENDING->value, 
                    NotificationStatusEnum::QUEUED->value,
                    NotificationStatusEnum::READ->value,
                )
            ],
        ];
    }
}
