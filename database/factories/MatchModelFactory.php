<?php

namespace Database\Factories;

use App\Models\MatchModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MatchModelFactory extends Factory
{
    protected $model = MatchModel::class;

    public function definition(): array
    {
        return [
            'title'      => $this->faker->word . ' Match',
            'venue'      => $this->faker->city . ' Cricket Ground',
            'match_type' => $this->faker->randomElement(['friendly', 'tournament']),
            'overs_limit' => $this->faker->randomElement([20, 50]),  // for T20, ODI etc.
            'start_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'status'     => 'scheduled',  // Or 'live' or 'completed'
            'created_by' => User::factory(),  // Automatically associates a user as the match creator
        ];
    }
}
