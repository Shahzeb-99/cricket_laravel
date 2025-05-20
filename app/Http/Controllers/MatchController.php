<?php

namespace App\Http\Controllers;

use App\Events\PlayerJoinedMatch;
use App\Http\Requests\MatchRequest;
use App\Http\Resources\MatchResource;
use App\Models\MatchModel;
use App\Models\MatchPermission;
use App\Models\Team;
use App\Models\Player;
use App\Models\MatchPlayer;
use App\Models\MatchTeam;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MatchController extends Controller
{

    use AuthorizesRequests;
    protected function successResponse($data, string $message = ''): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    protected function errorResponse(string $message, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }

    public function create(MatchRequest $request)
    {
        try {
            $data = $request->validated();

            $match = MatchModel::create($data);

            // Create Team A and Team B
            $teamA = Team::create([
                'name' => 'Team A',
                'created_by' => $match->created_by,
            ]);
            $teamB = Team::create([
                'name' => 'Team B',
                'created_by' => $match->created_by,
            ]);

            // Associate teams to the match with roles
            MatchTeam::create([
                'match_id' => $match->id,
                'team_id' => $teamA->id,
                'team_role' => 'team_a',
            ]);
            MatchTeam::create([
                'match_id' => $match->id,
                'team_id' => $teamB->id,
                'team_role' => 'team_b',
            ]);

            MatchPlayer::firstOrCreate([
                'match_id' => $match->id,
                'player_id' => $match->created_by,
                'team_id' => $teamA->id,
            ]);

            return $this->successResponse(new MatchResource($match), 'Match created successfully.');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Join match using code
     */
    public function join(Request $request)
    {
        $request->validate([
            'match_id' => 'required|exists:matches,id'
        ]);

        $match = MatchModel::find($request->match_id);

        if (!$match) {
            return $this->errorResponse('Match not found.', 404);
        }

        $player = Player::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        MatchPlayer::firstOrCreate([
            'match_id' => $match->id,
            'player_id' => $player->id,
        ]);


        broadcast(new PlayerJoinedMatch($match->id, $player));


        return $this->successResponse(null, 'Joined match successfully.');
    }

    /**
     * Assign player to a team in a match
     */
    public function assignPlayerTeam(Request $request)
    {
        $request->validate([
            'match_player_id' => 'required|exists:match_players,id',
            'team_id' => 'required|exists:teams,id'
        ]);

        $matchPlayer = MatchPlayer::with('match')->findOrFail($request->match_player_id);

        // 🔐 Authorization check
        $this->authorize('assignTeam', $matchPlayer);

        // ✅ Proceed if authorized
        $matchPlayer->team_id = $request->team_id;
        $matchPlayer->save();

        return response()->json(['message' => 'Team assignment updated.']);
    }

    /**
     * Start match (set batting and bowling teams, opening players)
     */
    public function start(Request $request, $matchId)
    {
        $request->validate([
            'batting_team_id' => 'required|exists:teams,id',
            'bowling_team_id' => 'required|exists:teams,id|different:batting_team_id',
            'striker_id' => 'required|exists:players,id',
            'non_striker_id' => 'required|exists:players,id|different:striker_id',
            'bowler_id' => 'required|exists:players,id',
        ]);

        $match = MatchModel::findOrFail($matchId);
        $match->status = 'started';
        $match->save();

        // Create an innings entry
        $innings = $match->innings()->create([
            'batting_team_id' => $request->batting_team_id,
            'bowling_team_id' => $request->bowling_team_id,
            'inning_number' => 1,
            'is_completed' => false,
        ]);

        $match->liveState()->updateOrCreate(
            ['match_id' => $match->id],
            [
                'current_innings' => $innings->id,
                'striker_id' => $request->striker_id,
                'non_striker_id' => $request->non_striker_id,
                'bowler_id' => $request->bowler_id,
                'current_over' => 1,
                'current_ball' => 1,
                'total_runs' => 0,
                'total_wickets' => 0,
                'overs_completed' => 0.0,
                'last_updated' => now(),
            ]
        );

        return response()->json(['message' => 'Match started.']);
    }

    /**
     * Assign umpire permission
     */
    public function assignUmpire(Request $request)
    {
        $request->validate([
            'match_id' => 'required|exists:matches,id',
            'user_id' => 'required|exists:users,id',
            'can_edit' => 'boolean',
            'can_delete' => 'boolean',
        ]);

        $permission = MatchPermission::updateOrCreate(
            ['match_id' => $request->match_id, 'user_id' => $request->user_id],
            [
                'role' => 'umpire',
                'can_edit' => $request->can_edit ?? true,
                'can_delete' => $request->can_delete ?? false,
            ]
        );

        return response()->json(['message' => 'Umpire access granted.']);
    }
}
