<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlertResource extends JsonResource
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
            'severity'=> $this->severity,
            'alert_type'=> $this->alert_type,
             'message'=> $this->message,
            'resolved'=> $this->resolved,
             'resolved_at'=> $this->resolved_at,
            'triggered_at'=> $this->triggered_at,

            'tank' => new TankResource(
                $this->whenLoaded('tank')
            )
        ];
    }
}
