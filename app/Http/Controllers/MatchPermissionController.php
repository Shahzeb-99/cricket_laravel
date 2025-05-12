<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchPermissionRequest;
use App\Http\Resources\MatchPermissionResource;
use App\Models\MatchPermission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MatchPermissionController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', MatchPermission::class);

        return MatchPermissionResource::collection(MatchPermission::all());
    }

    public function store(MatchPermissionRequest $request)
    {
        $this->authorize('create', MatchPermission::class);

        return new MatchPermissionResource(MatchPermission::create($request->validated()));
    }

    public function show(MatchPermission $matchPermission)
    {
        $this->authorize('view', $matchPermission);

        return new MatchPermissionResource($matchPermission);
    }

    public function update(MatchPermissionRequest $request, MatchPermission $matchPermission)
    {
        $this->authorize('update', $matchPermission);

        $matchPermission->update($request->validated());

        return new MatchPermissionResource($matchPermission);
    }

    public function destroy(MatchPermission $matchPermission)
    {
        $this->authorize('delete', $matchPermission);

        $matchPermission->delete();

        return response()->json();
    }
}
