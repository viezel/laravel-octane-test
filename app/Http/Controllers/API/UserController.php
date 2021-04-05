<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::query()->paginate());
    }

    public function show(int $userId)
    {
        $user = User::query()->findOrFail($userId);

        return response()->json($user);
    }
}
