<?php

namespace App\Http\Requests;

use App\Enums\FuelType;
use App\Enums\TankStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateTankRequest extends FormRequest
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
                'soetimes',
                'exists:terminals,id'
            ],

            'tank_number'=> [
                'sometimes',
                'string',
                'max:255',
                'unique:tanks,tanks_number'
            ],
             
            'name' => [
                'sometimes',
                'string',
                'max:255'
            ],

            'fuel_type' => [
                'sometimes', 
                new Enum(FuelType::class)
            ],

              'capacity' => [
                'sometimes',
                'numeric',
                'min:1'
            ],
              'safe_level' => [
                'sometimes',
                'numeric',
                'min:0'
            ],

                'critical_level' => [
                'sometimes',
                'numeric',
                'min:0'
            ],

                'status' => [
                'sometimes',
                new Enum(TankStatus::class)
            ],

        ];
    }
}
