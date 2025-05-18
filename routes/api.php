<?php

use App\Events\MessageSent;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Return the authenticated user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Test route for broadcasting (Reverb)
Route::get('/send-message', function () {
    broadcast(new MessageSent('Hello from Laravel Reverb!'));
    return 'Message sent';
});

// Authentication routes
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('password/reset-link', [AuthController::class, 'sendPasswordResetLink']);
    Route::post('password/reset', [AuthController::class, 'resetPassword']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'profile']);
    });
});

// User profile management (protected)
Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [UserController::class, 'show']);             // GET /user
    Route::post('/', [UserController::class, 'update']);           // POST /user
    Route::put('/password', [UserController::class, 'updatePassword']); // PUT /user/password
    Route::delete('/', [UserController::class, 'destroy']);       // DELETE /user
});

// Player profile management (protected)
Route::prefix('player')->middleware('auth:sanctum')->group(function () {
    Route::get('profile', [PlayerController::class, 'profile']); // GET /player/profile
    Route::post('/', [PlayerController::class, 'store']);        // POST /player
    Route::put('/', [PlayerController::class, 'update']);        // PUT /player
    Route::delete('/', [PlayerController::class, 'destroy']);    // DELETE /player
});

// Match management (protected)
Route::prefix('match')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [MatchController::class, 'create']); // Create a match
    Route::post('/join', [MatchController::class, 'join']); // Join a match by match_id
    Route::post('/assign-player-team', [MatchController::class, 'assignPlayerTeam']); // Assign player to team
    Route::post('/start/{matchId}', [MatchController::class, 'start']); // Start a match
    Route::post('/assign-umpire', [MatchController::class, 'assignUmpire']); // Assign umpire
});
