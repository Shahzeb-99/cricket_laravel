<?php

namespace Database\Factories;

use App\Models\Inning;
use App\Models\LiveMatchState;
use App\Models\MatchModel;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LiveMatchStateFactory extends Factory
{
    protected $model = LiveMatchState::class;

    public function definition(): array
    {
        return [
            'match_id' => MatchModel::factory(),
            'current_innings' => Inning::factory(),
            'striker_id' => Player::factory(),
            'non_striker_id' => Player::factory(),
            'bowler_id' => Player::factory(),
            'current_over' => $this->faker->numberBetween(0, 50),
            'current_ball' => $this->faker->numberBetween(0, 6),
            'total_runs' => $this->faker->numberBetween(0, 300),
            'total_wickets' => $this->faker->numberBetween(0, 10),
            'overs_completed' => $this->faker->randomFloat(1, 0, 50),
            'last_updated' => now(),
        ];
    }
}
