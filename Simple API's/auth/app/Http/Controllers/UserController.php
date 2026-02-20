<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
            'full_name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
            'birth_date' => 'required'
        ]);

        $user = User::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'birth_date' => $validated['birth_date'],
            'role_id' => 2
        ]);

        $user->with('role');

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Register Successfully',
            'data' => new UserResource($user, $token)
        ], 201);
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email or Password incorrect'
            ], 401);
        }
        
        $token = $user->createToken('auth-token')->plainTextToken;

        $user->with('role');

        return response()->json([
            'status' => 'success',
            'message' => 'login successfully',
            'data' => new UserResource($user, $token)
        ]);
    }

    public function logout(Request $request) {
        $user = $request->user();

        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'logout success'
        ]);
    }
}
