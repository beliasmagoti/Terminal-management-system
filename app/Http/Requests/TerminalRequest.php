<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TerminalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $terminalId = $this->route('terminal');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:terminals,name,' . $terminalId,
            ],

            'code' => [
                'required',
                'string',
                'max:50',
                'unique:terminals,code,' . $terminalId,
            ],

            'location' => [
                'required',
                'string',
                'max:255',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'country' => [
                'nullable',
                'string',
                'max:100',
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'capacity' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'status' => [
                'nullable',
                'in:active,inactive,maintenance',
            ],

            'manager_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'manager_phone' => [
                'nullable',
                'string',
                'max:20',
            ],
        ];
    }
}