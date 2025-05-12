<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\MatchModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'match_id' => MatchModel::factory(),  // Create a new match or associate with an existing match
            'user_id' => User::factory(),    // Create a new user or associate with an existing user
            'event_type' => $this->faker->randomElement(['ball_bowled', 'wicket_fallen', 'runs_scored']),
            'details' => json_encode([
                'runs' => $this->faker->numberBetween(0, 6),
                'wicket_type' => $this->faker->randomElement(['bowled', 'catch', 'lbw']),
                'bowler' => $this->faker->name,
                'striker' => $this->faker->name,
            ]),
        ];
    }
}
