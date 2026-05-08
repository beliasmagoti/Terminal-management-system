<?php

namespace App\Http\Requests;

use App\Enums\FuelType;
use App\Enums\TankStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'terminal_id'=> [
                'required',
                'exists:terminals,id'
            ],

            'tank_number'=> [
                'required',
                'string',
                'max:255',
                'unique:tanks,tanks_number'
            ],
             
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'fuel_type' => [
                'required', 
                new Enum(FuelType::class)
            ],

              'capacity' => [
                'required',
                'numeric',
                'min:1'
            ],
              'safe_level' => [
                'required',
                'numeric',
                'min:0'
            ],

                'critical_level' => [
                'required',
                'numeric',
                'min:0'
            ],

                'status' => [
                'nullable',
                new Enum(TankStatus::class)
            ],


        ];
    }
}
