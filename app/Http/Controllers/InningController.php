<?php

namespace App\Http\Controllers;

use App\Http\Requests\InningRequest;
use App\Http\Resources\InningResource;
use App\Models\Inning;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InningController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Inning::class);

        return InningResource::collection(Inning::all());
    }

    public function store(InningRequest $request)
    {
        $this->authorize('create', Inning::class);

        return new InningResource(Inning::create($request->validated()));
    }

    public function show(Inning $inning)
    {
        $this->authorize('view', $inning);

        return new InningResource($inning);
    }

    public function update(InningRequest $request, Inning $inning)
    {
        $this->authorize('update', $inning);

        $inning->update($request->validated());

        return new InningResource($inning);
    }

    public function destroy(Inning $inning)
    {
        $this->authorize('delete', $inning);

        $inning->delete();

        return response()->json();
    }
}
