<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TankRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tankId = $this->route('tank');

        return [
            'terminal_id' => [
                'required',
                'uuid',
                'exists:terminals,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'required',
                'string',
                'max:50',
                'unique:tanks,code,' . $tankId,
            ],

            'fuel_type' => [
                'required',
                'string',
                'max:100',
            ],

            'capacity_liters' => [
                'required',
                'numeric',
                'min:1',
            ],

            'current_level' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'status' => [
                'nullable',
                'in:active,inactive,maintenance',
            ],

            'temperature' => [
                'nullable',
                'numeric',
            ],

            'pressure' => [
                'nullable',
                'numeric',
            ],

            'installation_date' => [
                'nullable',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }
}