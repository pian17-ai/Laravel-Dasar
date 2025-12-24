<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterRequest $request) {
        $user = User::create($request->validated());

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'messages' => 'register success',
            'data' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'messages' => 'wrong email or password'
            ], 402);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'messages' => 'login success',
            'data' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request) {
        $user = $request->user();

        $user->tokens()->delete();

        return response()->json([
            'messages' => 'logout success'
        ], 200);
    }
}
