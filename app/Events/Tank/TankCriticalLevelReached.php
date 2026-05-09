<?php

namespace App\Events\Tank;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class TankCriticalLevelReached implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $tank;

    public function __construct(array $tank)
    {
        $this->tank = $tank;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('dashboard'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'tank.critical.level';
    }

    public function broadcastWith(): array
    {
        return [
            'tank' => $this->tank,
            'severity' => 'critical',
            'message' => 'Tank fuel level is CRITICAL',
        ];
    }
}