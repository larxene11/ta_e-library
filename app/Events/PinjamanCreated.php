<?php

namespace App\Events;

use App\Models\Pinjaman;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PinjamanCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $pinjaman;
    /**
     * Create a new event instance.
     */
    public function __construct(Pinjaman $pinjaman)
    {
        $this->pinjaman = $pinjaman;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
