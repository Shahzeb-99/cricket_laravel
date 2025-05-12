<?php

namespace Database\Factories;

use App\Models\Ball;
use App\Models\Over;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BallFactory extends Factory
{
    protected $model = Ball::class;

    public function definition(): array
    {
        return [
            'ball_number' => $this->faker->word(),
            'runs_scored' => $this->faker->word(),
            'extras' => $this->faker->words(),
            'is_wicket' => $this->faker->boolean(),
            'wicket_type' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'over_id' => Over::factory(),
            'striker_id' => Player::factory(),
            'non_striker_id' => Player::factory(),
            'bowler_id' => Player::factory(),
            'dismissed_player_id' => Player::factory(),
        ];
    }
}
