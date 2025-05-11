<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchRequest;
use App\Http\Resources\MatchResource;
use App\Models\MatchModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MatchController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', MatchModel::class);

        return MatchResource::collection(MatchModel::all());
    }

    public function store(MatchRequest $request)
    {
        $this->authorize('create', MatchModel::class);

        return new MatchResource(MatchModel::create($request->validated()));
    }

    public function show(MatchModel $match)
    {
        $this->authorize('view', $match);

        return new MatchResource($match);
    }

    public function update(MatchRequest $request, MatchModel $match)
    {
        $this->authorize('update', $match);

        $match->update($request->validated());

        return new MatchResource($match);
    }

    public function destroy(MatchModel $match)
    {
        $this->authorize('delete', $match);

        $match->delete();

        return response()->json();
    }
}
