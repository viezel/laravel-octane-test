<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    return response()->json(User::query()->paginate());
});

Route::get('/users/{userId}', function (int $userId) {
    return response()->json(User::query()->findOrFail($userId));
});

Route::get('/ping', function() {
    return response()->json(['message' => 'pong']);
});
