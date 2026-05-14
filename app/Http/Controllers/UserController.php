<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        return response()->json([
            'message' => 'Usuario registrado correctamente.',
            'user' => $user,
        ], 201);
    }
}
