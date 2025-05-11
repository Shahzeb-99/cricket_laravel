<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchTeamRequest;
use App\Http\Resources\MatchTeamResource;
use App\Models\MatchTeam;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MatchTeamController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', MatchTeam::class);

        return MatchTeamResource::collection(MatchTeam::all());
    }

    public function store(MatchTeamRequest $request)
    {
        $this->authorize('create', MatchTeam::class);

        return new MatchTeamResource(MatchTeam::create($request->validated()));
    }

    public function show(MatchTeam $matchTeam)
    {
        $this->authorize('view', $matchTeam);

        return new MatchTeamResource($matchTeam);
    }

    public function update(MatchTeamRequest $request, MatchTeam $matchTeam)
    {
        $this->authorize('update', $matchTeam);

        $matchTeam->update($request->validated());

        return new MatchTeamResource($matchTeam);
    }

    public function destroy(MatchTeam $matchTeam)
    {
        $this->authorize('delete', $matchTeam);

        $matchTeam->delete();

        return response()->json();
    }
}
