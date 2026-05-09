<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TankReadingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
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
            'tank_id' => [
                'required',
                'uuid',
                'exists:tanks,id',
            ],

            'sensor_id' => [
                'nullable',
                'uuid',
                'exists:sensors,id',
            ],

            'fuel_level' => [
                'required',
                'numeric',
                'min:0',
            ],

            'volume_liters' => [
                'required',
                'numeric',
                'min:0',
            ],

            'temperature' => [
                'nullable',
                'numeric',
            ],

            'water_level' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'pressure' => [
                'nullable',
                'numeric',
            ],

            'density' => [
                'nullable',
                'numeric',
            ],

            'reading_time' => [
                'required',
                'date',
            ],

            'status' => [
                'nullable',
                'in:normal,warning,critical',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    /**
     * Custom messages.
     */
    public function messages(): array
    {
        return [
            'tank_id.required' => 'Tank is required.',
            'tank_id.exists' => 'Selected tank does not exist.',

            'fuel_level.required' => 'Fuel level is required.',
            'volume_liters.required' => 'Volume in liters is required.',

            'reading_time.required' => 'Reading time is required.',

            'status.in' => 'Invalid reading status.',
        ];
    }
}