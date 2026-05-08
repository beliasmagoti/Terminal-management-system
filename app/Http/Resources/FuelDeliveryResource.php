<?php

namespace App\Http\Resources;

use App\Enums\DeliveryStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FuelDeliveryResource extends JsonResource
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
             'terminal'=>new TerminalResource(
                $this->whenLoaded('terminal')
             ),

             'tank' => new TankResource(
                $this->whenLoaded('tank')
             ),

             'supplier_name'=>$this->supplier_name,
             'fuel_type'=>$this->fuel_type,
             'density'=>$this->density,
             'temperature_celsius'=>$this->temperature_celsius,
             'quantity_liters'=>$this->quantity_liters,
             'delivery_reference'=>$this->delivery_reference,
             'delivered_at'=>$this->delivered_at,

             'received_by' => new UserResource(
                $this->whenLoaded('user')
             ),
            'status'=> DeliveryStatus::class




        ];
    }
}
