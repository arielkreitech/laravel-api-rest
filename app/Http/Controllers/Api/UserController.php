<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEmailRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserController extends Controller
{
    protected $service;

    public function __construct(UserServiceInterface $service){
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'users' => $this->service->getAllUsers()
        ]);
    }

    /**
     * Returns user data by email
     *
     * @param  UserEmailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function getUserByEmail(UserEmailRequest $request){

        $user = $this->service->getUserByWhere('email', $request->email)->first();

        if (!$user) {
            throw new ModelNotFoundException('User not found');
        }

        return response()->json([
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => !empty($request->phone) ? $request->phone : null,
                'id_card' => $request->id_card,
                'date_of_birth' => $request->date_of_birth,
                'city_code' => $request->city_code,
            ];
            $user = $this->service->createUser($data);
            return response()->json([
                'message' => 'Successfully created user!',
                'user' => $user
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Not created, something went wrong',
                'th' => $th
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->service->getUserById($id);

        if (!$user) {
            throw new ModelNotFoundException('User not found');
        }

        return response()->json([
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {

        try {
            $data = [
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'phone' => !empty($request->phone) ? $request->phone : null,
                'id_card' => $request->id_card,
                'date_of_birth' => $request->date_of_birth,
                'city_code' => $request->city_code,
            ];

            $this->service->updateUser($id, $data);

            return response()->json([
                'message' => 'Successfully updated user!'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Not updated, something went wrong',
                'th' => $th
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->service->deleteUser($id);

            return response()->json([
                'message' => 'Successfully Deleted'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Not deleted, something went wrong',
                'th' => $th
            ], 400);
        }
    }
}
