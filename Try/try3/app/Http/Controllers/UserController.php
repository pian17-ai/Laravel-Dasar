<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'messages' => 'register success',
            'data' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'messages' => 'wrong email or password'
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'messages' => 'login success',
            'data' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request) {
        if(!Auth::check()) {
            return response()->json([
                'messages' => 'unauthenticated'
            ], 401);
        }

        $request->user()->tokens()->delete();

        return response()->json([
            'messages' => 'logout success'
        ], 200);
    }
}
