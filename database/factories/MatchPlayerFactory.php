<?php

namespace Database\Factories;

use App\Models\MatchModel;
use App\Models\MatchPlayer;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MatchPlayerFactory extends Factory
{
    protected $model = \App\Models\MatchPlayer::class;

    public function definition(): array
    {
        return [
            'match_id' => MatchModelFactory::new()->create()->id,
            'player_id' => Player::factory(),
            'team_id' => Team::factory(),
            'role' => $this->faker->randomElement(['player', 'captain', 'vice_captain']),
        ];
    }
}
