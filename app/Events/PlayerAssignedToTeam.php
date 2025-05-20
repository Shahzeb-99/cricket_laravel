<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayerAssignedToTeam implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $matchId;
    public $matchPlayer;

    public function __construct($matchId, $matchPlayer)
    {
        $this->matchId = $matchId;
        $this->matchPlayer = $matchPlayer;
    }

    public function broadcastOn(): Channel
    {
        return new Channel("match.{$this->matchId}");
    }

    public function broadcastWith(): array
    {
        return [
            'match_player' => $this->matchPlayer,
        ];
    }
}
