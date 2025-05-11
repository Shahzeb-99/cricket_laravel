<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'email'      => $this->faker->unique()->safeEmail,
            'phone'      => $this->faker->phoneNumber,
            'role'       => $this->faker->randomElement(['batsman', 'bowler', 'all-rounder', 'wicketkeeper']),
            'date_of_birth' => $this->faker->date(),
            'status'     => $this->faker->randomElement(['active', 'inactive', 'suspended']),
            'team_id'    => Team::factory(), // Automatically assigns a team to the player
        ];
    }
}
