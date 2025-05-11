<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TeamController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Team::class);

        return TeamResource::collection(Team::all());
    }

    public function store(TeamRequest $request)
    {
        $this->authorize('create', Team::class);

        return new TeamResource(Team::create($request->validated()));
    }

    public function show(Team $team)
    {
        $this->authorize('view', $team);

        return new TeamResource($team);
    }

    public function update(TeamRequest $request, Team $team)
    {
        $this->authorize('update', $team);

        $team->update($request->validated());

        return new TeamResource($team);
    }

    public function destroy(Team $team)
    {
        $this->authorize('delete', $team);

        $team->delete();

        return response()->json();
    }
}
