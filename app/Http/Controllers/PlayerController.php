<?php

namespace App\Http\Controllers;

use App\Http\Requests\Player\PlayerRequest;
use App\Http\Requests\Player\UpdatePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;

class PlayerController extends Controller
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

    public function profile()
    {
        $user = auth()->user();
        $player = Player::with(['team', 'user'])->where('user_id', $user->id)->first();

        if (!$player) {
            return $this->errorResponse('Player profile not found', 404);
        }

        $this->authorize('view', $player);

        return $this->successResponse(new PlayerResource($player), 'Player profile retrieved successfully');
    }

    public function store(PlayerRequest $request)
    {
        $user = auth()->user();

        try {
            $this->authorize('create', Player::class);
        } catch (AuthorizationException $e) {
            return $this->errorResponse('You already have a player profile.', 403);
        }

        $data = $request->validated();

        $player = Player::create($data);

        $player->load(['user', 'team']);

        return $this->successResponse(new PlayerResource($player), 'Player profile created successfully');
    }


    public function update(UpdatePlayerRequest $request)
    {
        $user = auth()->user();
        $player = Player::where('user_id', $user->id)->first();

        if (!$player) {
            return $this->errorResponse('Player profile not found', 404);
        }

        $this->authorize('update', $player);

        $player->update($request->validated());

        // Eager load relationships for the resource
        $player->load(['user', 'team']);

        return $this->successResponse(new PlayerResource($player), 'Player profile updated successfully');
    }

    public function destroy()
    {
        $user = auth()->user();
        $player = Player::where('user_id', $user->id)->first();

        if (!$player) {
            return $this->errorResponse('Player profile not found', 404);
        }

        $this->authorize('delete', $player);

        $player->delete();

        return $this->successResponse(null, 'Player profile deleted successfully');
    }
}
