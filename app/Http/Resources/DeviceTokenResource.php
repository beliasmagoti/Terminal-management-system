<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceTokenResource extends JsonResource
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

            'token'=> $this->token,
            'expires_at'=>$this->expires_at,
            'name'=> $this->name,
            'user'=> new UserResource(
                $this->whenLoaded('user')
            ),

            'sensor'=> new SensorResource(
                $this->whenLoaded('sensor')
            )
        ];
    }
}
