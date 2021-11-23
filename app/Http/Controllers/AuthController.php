<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => bcrypt($validator['password']),
        ]);

        $token = $user->createToken($validator['name'])->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => "You Logout"
        ];
    }

    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validator['email'])->first();

        if (!Hash::check($validator['password'], $user->password)) {
            return response([
                'message' => 'Bad Cerd',
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return response($response, 201);
    }
}
