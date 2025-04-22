<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Requests\LoginRequest;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $existingUser = User::where('email', $request->email)->orWhere('name', $request->name)->first();
    
        if ($existingUser) {
            return response()->json([
                'success' => false,
                'message' => 'A név vagy az e-mail cím már foglalt.',
            ], 409);
        }
    
        $user = User::create([
            "name" => $request["name"],
            "email" => $request["email"],
            "password" => bcrypt($request["password"]),
            "admin" => $request[ "admin" ]
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Sikeres regisztráció',
            'data' => [
                'email' => $user->email,
            ],
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->plainTextToken;
    
            return response()->json([
                'success' => true,
                'message' => 'Sikeres bejelentkezés',
                'data' => [
                    'token' => $token,
                    'user' => new UserResource($user),
                ],
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hibás e-mail cím vagy jelszó',
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Sikeres kijelentkezés',
        ], 200);
    }
}