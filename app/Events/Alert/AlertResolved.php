<?php

namespace App\Events\Alert;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class AlertResolved implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $alert;

    /**
     * Create a new event instance.
     */
    public function __construct(array $alert)
    {
        $this->alert = $alert;
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
        return 'alert.resolved';
    }

    /**
     * Payload sent to frontend
     */
    public function broadcastWith(): array
    {
        return [
            'alert' => $this->alert,
            'message' => 'Alert resolved successfully',
            'status' => 'resolved',
            'timestamp' => now()->toDateTimeString(),
        ];
    }
}