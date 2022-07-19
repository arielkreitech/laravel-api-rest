<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * User Register
     */
    public function signUp(RegisterRequest $request){

        $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ]);

        return response()->json([
            'message' => 'Successfully created user!',
            'access_token' => $user->createToken($request->email)->plainTextToken,
            'user_id' => $user->id,
            'is_admin' => $user->is_admin,
            'token_type' => 'Bearer'
        ], 201);
    }

    /**
     * Login session and token create
     */
    public function login(LoginRequest $request){

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'access_token' => $user->createToken($request->email)->plainTextToken,
            'user_id' => $user->id,
            'is_admin' => $user->is_admin,
            'token_type' => 'Bearer'
        ]);
    }

    /**
     * Close session
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
