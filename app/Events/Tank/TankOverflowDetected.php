<?php

namespace App\Events\Tank;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class TankOverflowDetected implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $tank;

    /**
     * Create a new event instance.
     */
    public function __construct(array $tank)
    {
        $this->tank = $tank;
    }

    /**
     * Broadcast channels
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('dashboard'),
        ];
    }

    /**
     * Event name for frontend
     */
    public function broadcastAs(): string
    {
        return 'tank.overflow.detected';
    }

    /**
     * Payload sent to frontend
     */
    public function broadcastWith(): array
    {
        return [
            'tank' => $this->tank,
            'severity' => 'critical',
            'message' => 'Tank overflow detected! Immediate action required.',
        ];
    }
}