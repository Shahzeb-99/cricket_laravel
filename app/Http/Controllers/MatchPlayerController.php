<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchPlayerRequest;
use App\Http\Resources\MatchPlayerResource;
use App\Models\MatchPlayer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MatchPlayerController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', MatchPlayer::class);

        return MatchPlayerResource::collection(MatchPlayer::all());
    }

    public function store(MatchPlayerRequest $request)
    {
        $this->authorize('create', MatchPlayer::class);

        return new MatchPlayerResource(MatchPlayer::create($request->validated()));
    }

    public function show(MatchPlayer $matchPlayer)
    {
        $this->authorize('view', $matchPlayer);

        return new MatchPlayerResource($matchPlayer);
    }

    public function update(MatchPlayerRequest $request, MatchPlayer $matchPlayer)
    {
        $this->authorize('update', $matchPlayer);

        $matchPlayer->update($request->validated());

        return new MatchPlayerResource($matchPlayer);
    }

    public function destroy(MatchPlayer $matchPlayer)
    {
        $this->authorize('delete', $matchPlayer);

        $matchPlayer->delete();

        return response()->json();
    }
}
