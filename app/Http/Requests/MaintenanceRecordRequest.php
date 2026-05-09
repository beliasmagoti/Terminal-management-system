<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRecordRequest extends FormRequest
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

            'performed_by' => [
                'required',
                'uuid',
                'exists:users,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'maintenance_type' => [
                'required',
                'in:preventive,corrective,inspection,calibration,repair',
            ],

            'status' => [
                'nullable',
                'in:pending,in_progress,completed,cancelled',
            ],

            'scheduled_at' => [
                'nullable',
                'date',
            ],

            'started_at' => [
                'nullable',
                'date',
            ],

            'completed_at' => [
                'nullable',
                'date',
            ],

            'cost' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'vendor_name' => [
                'nullable',
                'string',
                'max:255',
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
            'performed_by.required' => 'Technician is required.',
            'performed_by.exists' => 'Selected technician does not exist.',

            'title.required' => 'Maintenance title is required.',
            'description.required' => 'Maintenance description is required.',

            'maintenance_type.required' => 'Maintenance type is required.',
            'maintenance_type.in' => 'Invalid maintenance type.',

            'status.in' => 'Invalid maintenance status.',
        ];
    }
}