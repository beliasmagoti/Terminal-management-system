<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceTokenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'uuid',
                'exists:users,id',
            ],

            'token' => [
                'required',
                'string',
                'max:500',
                'unique:device_tokens,token',
            ],

            'device_type' => [
                'required',
                'in:android,ios,web',
            ],

            'device_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'last_used_at' => [
                'nullable',
                'date',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User is required.',
            'token.required' => 'Device token is required.',
            'token.unique' => 'Device token already exists.',
            'device_type.required' => 'Device type is required.',
        ];
    }
}