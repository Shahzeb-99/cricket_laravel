<?php

namespace Database\Factories;

use App\Models\Inning;
use App\Models\Over;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OverFactory extends Factory
{
    protected $model = Over::class;

    public function definition(): array
    {
        return [
            'innings_id' => Inning::factory(),
            'over_number' => $this->faker->numberBetween(1, 50),
            'bowler_id' => Player::factory(),
            'total_runs' => $this->faker->numberBetween(0, 36),
            'total_wickets' => $this->faker->numberBetween(0, 2),
        ];
    }
}
