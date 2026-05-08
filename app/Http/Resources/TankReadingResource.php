<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TankReadingResource extends JsonResource
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
            'fuel_level_liters'=> $this->fuel_level_liters,
            'name'=> $this->name,
            'fuel_level_percent'=> $this->fuel_level_percent,
            'density'=> $this->density,
            'current_volume'=> $this->current_volume,
            'safe_level'=> $this->safe_level,
            'water_level'=>$this->water_level,
            'critical_level'=> $this->critical_level,
            'temperature_percent'=> $this->temperature_percent,
            'pressure_kpa'=> $this->pressure_kpa,
            'status'=> $this->status,
            'recorded_at'=>$this->recorded_at,


            'tank' => new TankResource(
                $this->whenLoaded('tank')
            ),

            'sensor'=> new SensorResource(
                $this->whenLoaded('sensor')
            )

           

        ];
    }
}
