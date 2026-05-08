<?php

namespace App\Http\Requests\Sensor;

use Illuminate\Foundation\Http\FormRequest;

class SensorRequest extends FormRequest
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
        $sensorId = $this->route('sensor');

        return [
            'tank_id' => [
                'required',
                'uuid',
                'exists:tanks,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'serial_number' => [
                'required',
                'string',
                'max:255',
                'unique:sensors,serial_number,' . $sensorId,
            ],

            'type' => [
                'required',
                'in:level,temperature,pressure,water_level,multi',
            ],

            'manufacturer' => [
                'nullable',
                'string',
                'max:255',
            ],

            'model' => [
                'nullable',
                'string',
                'max:255',
            ],

            'installation_date' => [
                'nullable',
                'date',
            ],

            'last_calibrated_at' => [
                'nullable',
                'date',
            ],

            'firmware_version' => [
                'nullable',
                'string',
                'max:100',
            ],

            'ip_address' => [
                'nullable',
                'ip',
            ],

            'status' => [
                'nullable',
                'in:active,inactive,maintenance,faulty',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'tank_id.required' => 'Tank is required.',
            'tank_id.exists' => 'Selected tank does not exist.',

            'serial_number.required' => 'Sensor serial number is required.',
            'serial_number.unique' => 'Sensor serial number already exists.',

            'type.required' => 'Sensor type is required.',
            'type.in' => 'Invalid sensor type.',

            'status.in' => 'Invalid sensor status.',
        ];
    }
}