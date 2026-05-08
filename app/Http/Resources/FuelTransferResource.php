<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FuelTransferResource extends JsonResource
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
             'transfer_type'=> $this->transfer_type,
            
             'from_tank_id' => new TankResource(
                $this->whenLoaded('tank')
             ),

             'to_tank_id' => new TankResource(
                $this->whenLoaded('tank')
             ),

             'transferred_at'=>$this-> transferred_at,
             'transferred_by'=> new UserResource(
                $this->whenLoaded('user')
             )
        ];
    }
}
