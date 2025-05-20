<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('match.{id}', function ($user, $id) {
    \Log::info('Broadcast auth attempt', ['user' => $user?->id, 'match_id' => $id]);

    return true; // Just to confirm it's being hit
});

