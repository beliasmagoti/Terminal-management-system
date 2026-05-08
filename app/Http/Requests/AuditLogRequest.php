<?php

namespace App\Http\Requests\AuditLog;

use Illuminate\Foundation\Http\FormRequest;

class AuditLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => [
                'nullable',
                'uuid',
                'exists:users,id',
            ],

            'action' => [
                'required',
                'string',
                'max:255',
            ],

            'model_type' => [
                'required',
                'string',
                'max:255',
            ],

            'model_id' => [
                'required',
                'uuid',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'ip_address' => [
                'nullable',
                'ip',
            ],

            'user_agent' => [
                'nullable',
                'string',
            ],

            'old_values' => [
                'nullable',
                'array',
            ],

            'new_values' => [
                'nullable',
                'array',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'action.required' => 'Action is required.',
            'model_type.required' => 'Model type is required.',
            'model_id.required' => 'Model ID is required.',
        ];
    }
}