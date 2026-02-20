<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6'
        ]);

        $user = User::where('name', $request->name)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'messages' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('api-tokens')->plainTextToken;

        return response()->json([
            'messages' => 'Login success',
            'token' => $token
        ]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'messages' => 'Logout out'
        ]);
    }
}
