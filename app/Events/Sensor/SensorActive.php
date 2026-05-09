<?php

namespace App\Events\Sensor;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class SensorActive implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $sensor;

    /**
     * Create a new event instance.
     */
    public function __construct(array $sensor)
    {
        $this->sensor = $sensor;
    }

    /**
     * Broadcast channels
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('dashboard'),
        ];
    }

    /**
     * Event name for frontend
     */
    public function broadcastAs(): string
    {
        return 'sensor.active';
    }

    /**
     * Data sent to frontend
     */
    public function broadcastWith(): array
    {
        return [
            'sensor' => $this->sensor,
            'status' => 'active',
            'message' => 'Sensor is now active',
        ];
    }
}