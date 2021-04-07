<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Octane\Facades\Octane;

Route::get('/users', function () {
    return response()->json(User::query()->paginate());
});

Route::get('/users/{userId}', function (int $userId) {
    return response()->json(User::query()->findOrFail($userId));
});

Route::get('/ping', function() {
    return response()->json(['message' => 'pong']);
});

Octane::route('GET', '/fast', function() {
    return response()->json(['message' => 'Octane pong']);
});
