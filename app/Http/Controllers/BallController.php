<?php

namespace App\Http\Controllers;

use App\Http\Requests\BallRequest;
use App\Http\Resources\BallResource;
use App\Models\Ball;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BallController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Ball::class);

        return BallResource::collection(Ball::all());
    }

    public function store(BallRequest $request)
    {
        $this->authorize('create', Ball::class);

        return new BallResource(Ball::create($request->validated()));
    }

    public function show(Ball $ball)
    {
        $this->authorize('view', $ball);

        return new BallResource($ball);
    }

    public function update(BallRequest $request, Ball $ball)
    {
        $this->authorize('update', $ball);

        $ball->update($request->validated());

        return new BallResource($ball);
    }

    public function destroy(Ball $ball)
    {
        $this->authorize('delete', $ball);

        $ball->delete();

        return response()->json();
    }
}
