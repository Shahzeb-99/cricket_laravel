<?php

namespace Database\Factories;

use App\Models\MatchModel;
use App\Models\MatchTeam;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MatchTeamFactory extends Factory
{
    protected $model = \App\Models\MatchTeam::class;

    public function definition(): array
    {
        return [
            'match_id' => MatchModelFactory::new()->create()->id,
            'team_id'  => Team::factory(),
            'team_role' => $this->faker->randomElement(['team_a', 'team_b']),
        ];
    }
}
