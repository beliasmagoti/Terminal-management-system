<?php

namespace App\Http\Requests\FuelTransfer;

use Illuminate\Foundation\Http\FormRequest;

class FuelTransferRequest extends FormRequest
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
            'source_tank_id' => [
                'required',
                'uuid',
                'different:destination_tank_id',
                'exists:tanks,id',
            ],

            'destination_tank_id' => [
                'required',
                'uuid',
                'different:source_tank_id',
                'exists:tanks,id',
            ],

            'performed_by' => [
                'required',
                'uuid',
                'exists:users,id',
            ],

            'volume_liters' => [
                'required',
                'numeric',
                'min:1',
            ],

            'fuel_type' => [
                'required',
                'string',
                'max:100',
            ],

            'transfer_date' => [
                'required',
                'date',
            ],

            'status' => [
                'nullable',
                'in:pending,in_progress,completed,cancelled',
            ],

            'reference_number' => [
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
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'source_tank_id.required' => 'Source tank is required.',
            'destination_tank_id.required' => 'Destination tank is required.',

            'source_tank_id.different' =>
                'Source and destination tanks must be different.',

            'destination_tank_id.different' =>
                'Destination and source tanks must be different.',

            'performed_by.required' =>
                'Operator is required.',

            'volume_liters.required' =>
                'Transfer volume is required.',

            'volume_liters.min' =>
                'Transfer volume must be greater than zero.',

            'transfer_date.required' =>
                'Transfer date is required.',

            'status.in' =>
                'Invalid transfer status.',
        ];
    }
}