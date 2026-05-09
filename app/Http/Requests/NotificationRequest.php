<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    /**
     * Determine if user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'uuid',
                'exists:users,id',
            ],

            'tank_id' => [
                'nullable',
                'uuid',
                'exists:tanks,id',
            ],

            'sensor_id' => [
                'nullable',
                'uuid',
                'exists:sensors,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'message' => [
                'required',
                'string',
            ],

            'type' => [
                'required',
                'in:info,warning,critical,maintenance,system',
            ],

            'channel' => [
                'nullable',
                'in:email,sms,push,in_app',
            ],

            'status' => [
                'nullable',
                'in:pending,sent,failed,read',
            ],

            'sent_at' => [
                'nullable',
                'date',
            ],

            'read_at' => [
                'nullable',
                'date',
            ],

            'metadata' => [
                'nullable',
                'array',
            ],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'User is required.',
            'user_id.exists' => 'Selected user does not exist.',

            'title.required' => 'Notification title is required.',
            'message.required' => 'Notification message is required.',

            'type.required' => 'Notification type is required.',
            'type.in' => 'Invalid notification type.',

            'channel.in' => 'Invalid notification channel.',
            'status.in' => 'Invalid notification status.',
        ];
    }
}