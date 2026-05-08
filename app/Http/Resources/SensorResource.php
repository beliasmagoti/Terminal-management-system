<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SensorResource extends JsonResource
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
            'serial_number'=> $this->serial_number,
            'sensor_type'=> $this->sensor_type,
             'manufacturer'=> $this->manufacturer,
            'installation_date'=> $this->installation_date,
             'last_maintenance_date'=> $this->id,
            'status'=> $this->status,

            'tank' => new TankResource(
                $this->whenLoaded('tank')
            )
        ];
    }
}
