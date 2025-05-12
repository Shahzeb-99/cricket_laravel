<?php

namespace Database\Seeders;

// database/seeders/DatabaseSeeder.php
use App\Models\MatchModel;
use Database\Factories\MatchModelFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use App\Models\Player;
use App\Models\MatchTeam;
use App\Models\MatchPlayer;
use App\Models\Inning;
use App\Models\Over;
use App\Models\Ball;
use App\Models\LiveMatchState;
use App\Models\Event;
use App\Models\MatchPermission;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Users
        User::truncate();
        $users = User::factory(10)->create(); // Generate 10 users

        // Seed Teams
        Team::truncate();
        $teams = Team::factory(5)->create(); // Generate 5 teams

        // Seed Matches
        MatchModel::truncate();
        $matches = MatchModelFactory::new()->count(3)->create(); // Generate 3 matches

        // Seed Match Players (linking players to a match and a team)
        MatchPlayer::truncate();
        foreach ($matches as $match) {
            $players = Player::factory(11)->create(); // Generate 11 players for each match
            foreach ($players as $player) {
                MatchPlayer::factory()->create([
                    'match_id' => $match->id,
                    'player_id' => $player->id,
                    'team_id' => $teams->random()->id,
                ]);
            }
        }

        // Seed Match Teams (linking teams to a match with roles)
        MatchTeam::truncate();
        foreach ($matches as $match) {
            MatchTeam::factory()->create([
                'match_id' => $match->id,
                'team_id' => $teams->random()->id,
                'team_role' => 'team_a', // Assuming "team_a" and "team_b" are the roles
            ]);
            MatchTeam::factory()->create([
                'match_id' => $match->id,
                'team_id' => $teams->random()->id,
                'team_role' => 'team_b',
            ]);
        }

        // Seed Balls (associated with match's overs)
        Ball::truncate();
        foreach ($matches as $match) {
            $innings = $match->innings; // Assuming each match has innings
            foreach ($innings as $inning) {
                $overs = Over::factory(5)->create([
                    'innings_id' => $inning->id,
                ]);

                foreach ($overs as $over) {
                    Ball::factory(6)->create([
                        'over_id' => $over->id,
                    ]);
                }
            }
        }

        // Seed Events (linking to matches and users)
        Event::truncate();
        foreach ($matches as $match) {
            Event::factory(5)->create([
                'match_id' => $match->id,
                'user_id' => $users->random()->id,
            ]);
        }

        // Seed Innings (linking to matches)
        Inning::truncate();
        foreach ($matches as $match) {
            Inning::factory()->create([
                'match_id' => $match->id,
                'batting_team_id' => $teams->random()->id,
                'bowling_team_id' => $teams->random()->id,
            ]);
        }

        // Seed Overs (linked to innings and bowler)
        Over::truncate();
        foreach ($matches as $match) {
            $innings = $match->innings; // Assuming each match has innings
            foreach ($innings as $inning) {
                Over::factory(5)->create([
                    'innings_id' => $inning->id,
                    'bowler_id' => $players->random()->id, // Random bowler
                ]);
            }
        }

        // Seed Players (teams associated)
        Player::truncate();
        $players = Player::factory(20)->create(); // Generate 20 players
        foreach ($players as $player) {
            $player->update([
                'team_id' => $teams->random()->id, // Assign a random team to the player
            ]);
        }





        // Seed Live Match State (linked to matches)
        LiveMatchState::truncate();
        foreach ($matches as $match) {
            LiveMatchState::factory()->create([
                'match_id' => $match->id,
                'current_innings' => 1,
                'striker_id' => $players->random()->id,
                'non_striker_id' => $players->random()->id,
                'bowler_id' => $players->random()->id,
            ]);
        }

        // Seed Match Permissions (linked to matches and users)
        MatchPermission::truncate();
        foreach ($matches as $match) {
            MatchPermission::factory(2)->create([
                'match_id' => $match->id,
                'user_id' => $users->random()->id,
            ]);
        }


    }
}
