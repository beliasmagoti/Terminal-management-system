<?php

namespace App\Events\MaintenanceRecord;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class MaintenanceScheduled implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $maintenance;

    /**
     * Create a new event instance.
     */
    public function __construct(array $maintenance)
    {
        $this->maintenance = $maintenance;
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
     * Frontend event name
     */
    public function broadcastAs(): string
    {
        return 'maintenance.scheduled';
    }

    /**
     * Payload sent to frontend
     */
    public function broadcastWith(): array
    {
        return [
            'maintenance' => $this->maintenance,
            'status' => 'scheduled',
            'message' => 'Maintenance has been scheduled',
            'timestamp' => now()->toDateTimeString(),
        ];
    }
}