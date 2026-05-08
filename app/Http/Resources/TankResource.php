<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TankResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'uuid'=> $this->uuid,
            'tank_number'=> $this->tank_number,
            'name'=> $this->name,
            'fuel_type'=> $this->fuel_type,
            'capacity'=> $this->capacity,
            'current_volume'=> $this->current_volume,
            'safe_level'=> $this->safe_level,
            'critical_level'=> $this->critical_level,
            'temperature'=> $this->temperature,
            'pressure'=> $this->pressure,
            'status'=> $this->status,

            'terminal' => new TerminalResource (
                $this->whenLoaded('terminal')
            ),

        ];
    }
}
