<?php

namespace App\Http\Requests\FuelDelivery;

use Illuminate\Foundation\Http\FormRequest;

class FuelDeliveryRequest extends FormRequest
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
                'required',
                'uuid',
                'exists:tanks,id',
            ],

            'supplier_id' => [
                'nullable',
                'uuid',
                'exists:suppliers,id',
            ],

            'received_by' => [
                'required',
                'uuid',
                'exists:users,id',
            ],

            'fuel_type' => [
                'required',
                'string',
                'max:100',
            ],

            'volume_liters' => [
                'required',
                'numeric',
                'min:1',
            ],

            'delivery_date' => [
                'required',
                'date',
            ],

            'reference_number' => [
                'nullable',
                'string',
                'max:255',
            ],

            'truck_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'driver_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'temperature' => [
                'nullable',
                'numeric',
            ],

            'density' => [
                'nullable',
                'numeric',
            ],

            'status' => [
                'nullable',
                'in:pending,received,verified,rejected',
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
            'tank_id.required' =>
                'Tank is required.',

            'tank_id.exists' =>
                'Selected tank does not exist.',

            'received_by.required' =>
                'Receiver is required.',

            'fuel_type.required' =>
                'Fuel type is required.',

            'volume_liters.required' =>
                'Delivery volume is required.',

            'volume_liters.min' =>
                'Delivery volume must be greater than zero.',

            'delivery_date.required' =>
                'Delivery date is required.',

            'status.in' =>
                'Invalid delivery status.',
        ];
    }
}