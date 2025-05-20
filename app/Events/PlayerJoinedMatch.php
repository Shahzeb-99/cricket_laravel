<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class PlayerJoinedMatch implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $matchId;
    public $player;

    public function __construct($matchId, $player)
    {
        $this->matchId = $matchId;
        $this->player = $player;
    }


    public function broadcastOn(): Channel
    {
        return new PrivateChannel('match.' . $this->matchId);
    }

    public function broadcastWith(): array
    {
        return [
            'player' => $this->player,
        ];
    }
}
