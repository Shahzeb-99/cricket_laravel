<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\TeamRequest;
use App\Http\Resources\TeamResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Team::class);
        $teams = Team::with('creator')->latest()->get();
        return TeamResource::collection($teams);
    }

    public function store(TeamRequest $request)
    {
        $this->authorize('create', Team::class);
        $team = Team::create([
            'name' => $request->name,
            'created_by' => Auth::id(),
        ]);
        $team->load('creator');
        return (new TeamResource($team))->response()->setStatusCode(201);
    }

    public function show($id)
    {
        $team = Team::with('creator')->findOrFail($id);
        $this->authorize('view', $team);
        return new TeamResource($team);
    }

    public function update(TeamRequest $request, $id)
    {
        $team = Team::findOrFail($id);
        $this->authorize('update', $team);
        $team->update($request->only(['name']));
        $team->load('creator');
        return new TeamResource($team);
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $this->authorize('delete', $team);
        $team->delete();
        return response()->json(['message' => 'Team deleted']);
    }
}
