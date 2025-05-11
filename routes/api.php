<?php

use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/send-message', function () {
    broadcast(new MessageSent('Hello from Laravel Reverb!'));
    return 'Message sent';
});
