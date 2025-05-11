<?php

namespace Database\Factories;

use App\Models\Inning;
use App\Models\MatchModel;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InningFactory extends Factory
{
    protected $model = Inning::class;

    public function definition(): array
    {
        return [
            'match_id' => MatchModel::factory(),
            'batting_team_id' => Team::factory(),
            'bowling_team_id' => Team::factory(),
            'inning_number' => 1,
            'is_completed' => false,
            'total_runs' => $this->faker->numberBetween(0, 250),
            'total_wickets' => $this->faker->numberBetween(0, 10),
            'total_overs' => $this->faker->numberBetween(0, 20),
        ];

    }
}
