<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use App\Services\Contracts\UserServiceInterface;

class AuthController extends Controller
{
    protected $service;

    public function __construct(UserServiceInterface $service){
        $this->service = $service;
    }

    /**
     * User Register
     *
     * @param  RegisterRequest  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function signUp(RegisterRequest $request){

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
                ];

            $user = $this->service->createUser($data);

            return response()->json([
                'message' => 'Successfully created user!',
                'access_token' => $user->createToken($request->email)->plainTextToken,
                'user_id' => $user->id,
                'is_admin' => $user->is_admin,
                'token_type' => 'Bearer'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Not register, something went wrong',
                'th' => $th
            ], 400);
        }

    }

    /**
     * Login session and token create
     *
     * @param  LoginRequest  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function login(LoginRequest $request){

        try {
            $user = $this->service->getUserByWhere('email', $request->email)->first();

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
        } catch (\Throwable $th) {
            return response()->json([
                'error' => [
                    'th' => $th,
                    'message' => 'something_went_wrong'
                ]
            ], 400);
        }


    }

    /**
     * Close session
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
