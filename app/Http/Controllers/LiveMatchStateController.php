<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiveMatchStateRequest;
use App\Http\Resources\LiveMatchStateResource;
use App\Models\LiveMatchState;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LiveMatchStateController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', LiveMatchState::class);

        return LiveMatchStateResource::collection(LiveMatchState::all());
    }

    public function store(LiveMatchStateRequest $request)
    {
        $this->authorize('create', LiveMatchState::class);

        return new LiveMatchStateResource(LiveMatchState::create($request->validated()));
    }

    public function show(LiveMatchState $liveMatchState)
    {
        $this->authorize('view', $liveMatchState);

        return new LiveMatchStateResource($liveMatchState);
    }

    public function update(LiveMatchStateRequest $request, LiveMatchState $liveMatchState)
    {
        $this->authorize('update', $liveMatchState);

        $liveMatchState->update($request->validated());

        return new LiveMatchStateResource($liveMatchState);
    }

    public function destroy(LiveMatchState $liveMatchState)
    {
        $this->authorize('delete', $liveMatchState);

        $liveMatchState->delete();

        return response()->json();
    }
}
