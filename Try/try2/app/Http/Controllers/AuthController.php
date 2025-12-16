<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'messages' => 'register success',
            'token' => $token
        ]);
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'messages' => 'invalid username or password'
            ], 401);
        }
        
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
            'messages' => 'login success'
        ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete;

        return response()->json([
            'messages' => 'logout success'
        ]);
    }
}
