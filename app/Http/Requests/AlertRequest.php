<?php

namespace App\Http\Requests\Alert;

use Illuminate\Foundation\Http\FormRequest;

class AlertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
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

            'type' => [
                'required',
                'in:low_fuel,high_temperature,leak_detected,sensor_failure,maintenance_due,system',
            ],

            'severity' => [
                'required',
                'in:low,medium,high,critical',
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

            'status' => [
                'nullable',
                'in:active,resolved,ignored',
            ],

            'resolved_at' => [
                'nullable',
                'date',
            ],

            'metadata' => [
                'nullable',
                'array',
            ],
        ];
    }
}