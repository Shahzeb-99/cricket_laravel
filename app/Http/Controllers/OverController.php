<?php

namespace App\Http\Controllers;

use App\Http\Requests\OverRequest;
use App\Http\Resources\OverResource;
use App\Models\Over;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OverController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Over::class);

        return OverResource::collection(Over::all());
    }

    public function store(OverRequest $request)
    {
        $this->authorize('create', Over::class);

        return new OverResource(Over::create($request->validated()));
    }

    public function show(Over $over)
    {
        $this->authorize('view', $over);

        return new OverResource($over);
    }

    public function update(OverRequest $request, Over $over)
    {
        $this->authorize('update', $over);

        $over->update($request->validated());

        return new OverResource($over);
    }

    public function destroy(Over $over)
    {
        $this->authorize('delete', $over);

        $over->delete();

        return response()->json();
    }
}
