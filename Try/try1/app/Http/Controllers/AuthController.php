<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('users-token')->plainTextToken;

        return response()->json([
            'messages' => 'register success',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'messages' => 'email or password error'
            ]);
        }

        $token = $user->createToken('users-token')->plainTextToken;

        return response()->json([
            'messages' => 'login success',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken();

        return response()->json([
            'messages' => 'logged'
        ]);
    }
}
