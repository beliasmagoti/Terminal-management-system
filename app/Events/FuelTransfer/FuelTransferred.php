<?php

namespace App\Events\FuelTransfer;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class FuelTransferred implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $transfer;

    /**
     * Create a new event instance.
     */
    public function __construct(array $transfer)
    {
        $this->transfer = $transfer;
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
        return 'fuel.transferred';
    }

    /**
     * Payload sent to frontend
     */
    public function broadcastWith(): array
    {
        return [
            'transfer' => $this->transfer,
            'message' => 'Fuel transferred successfully',
            'timestamp' => now()->toDateTimeString(),
        ];
    }
}