<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PlayerController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        // Return a paginated collection of players
        return PlayerResource::collection(Player::paginate(10));
    }

    public function show($id)
    {
        // Return a single player
        $player = Player::findOrFail($id);
        return new PlayerResource($player);
    }

    public function store(PlayerRequest $request)
    {
        // Validate the incoming request
        $validated = $request->validated();

        // Create the player record
        $player = Player::create($validated);

        // Return the newly created player as a resource
        return new PlayerResource($player);
    }

    public function update(PlayerRequest $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validated();

        // Find the player
        $player = Player::findOrFail($id);

        // Update the player record
        $player->update($validated);

        // Return the updated player as a resource
        return new PlayerResource($player);
    }

    public function destroy($id)
    {
        // Find and delete the player
        $player = Player::findOrFail($id);
        $player->delete();

        // Return a success response
        return response()->json(['message' => 'Player deleted successfully']   );
    }
}
