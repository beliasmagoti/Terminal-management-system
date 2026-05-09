<?php

namespace App\Events\Sensor;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class SensorReadingUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $reading;

    /**
     * Create a new event instance.
     */
    public function __construct(array $reading)
    {
        $this->reading = $reading;
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
        return 'sensor.reading.updated';
    }

    /**
     * Payload sent to frontend
     */
    public function broadcastWith(): array
    {
        return [
            'reading' => $this->reading,
            'message' => 'Sensor reading updated',
        ];
    }
}