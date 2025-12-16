<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRequest $request){
        $validation = $request->validated();

        $user = User::create([
            'username' => $validation['username'],
            'password' => Hash::make($validation['password']),
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'messages' => 'register success',
            'user' => new AuthResource($user),
            'token' => $token
        ], 201);

    }

    public function login(AuthRequest $request) {

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'messages' => 'invalid username or password'
            ], 401);
        }
        
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user->username,
            'messages' => 'login success'
        ]);
    }

    public function logout(Request $request){
        if(!Auth::check()) {
            return response()->json([
                'messages' => 'unauthorized'
            ], 401);
        }

        $request->user()->tokens()->delete();

        return response()->json([
            'messages' => 'logout success'
        ], 200);
    }
}
