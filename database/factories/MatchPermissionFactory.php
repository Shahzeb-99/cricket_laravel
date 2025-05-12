<?php

namespace Database\Factories;

use App\Models\MatchModel;
use App\Models\MatchPermission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MatchPermissionFactory extends Factory
{
    protected $model = MatchPermission::class;

    public function definition(): array
    {
        return [
            'role' => $this->faker->randomElement(['scorer', 'viewer', 'admin']),
            'can_edit' => $this->faker->boolean(),
            'can_delete' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'match_id' => MatchModel::factory(),
            'user_id' => User::factory(),
        ];
    }
}
