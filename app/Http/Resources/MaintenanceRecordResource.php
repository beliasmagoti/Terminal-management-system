<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceRecordResource extends JsonResource
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
             'description'=> $this->description,
             'maintenance_date'=> $this->maintenance_date,
          

            'sensor' => new SensorResource(
                $this->whenLoaded('sensor')
            ),

            'tank' => new TankResource(
                $this->whenLoaded('tank')
            ),

            'performed_by' =>new UserResource(
                $this->whenLoaded('user')
            )

        ];   
        
        
        }
}
