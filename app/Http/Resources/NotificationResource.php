<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
             'title'=> $this->title,
            'message'=> $this->message,
             'sent_at'=> $this->sent_at,
            'is_read'=> $this->is_read,

            'user' => new UserResource(
                $this->whenLoaded('user')
            ),

            'tank' => new TankResource(
                $this->whenLoaded('tank')
            )
        ];
    }
}
