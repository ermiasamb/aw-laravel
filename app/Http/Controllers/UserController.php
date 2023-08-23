<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users|max:255',
        'phone' => 'required|string|max:255',
        'language' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'password' => 'required|string|min:8|max:255',
    ]);
    $user = User::create(array_merge($request->all(), [
        'password' => Hash::make($request->password),
    ]));
    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'data' => $user
    ]);
}

public function login(Request $request)
{ 
    $validatedData = $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8|max:255',
    ]);
    
    $credentials = $request->only('email', 'password');
    if (!Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'Invalid login credentials',
        ], 401);
    }

    $user = User::where('email', $validatedData['email'])->firstOrFail();

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
}
}
