<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Contracts\IUserRepository;


class UserController extends Controller
{
    protected $repository;

    public function __construct(IUserRepository $repository){
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'users' => $this->repository->all()
        ]);
    }

    /**
     * Returns user data by email
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUserByEmail(Request $request){

        $request->validate([
            'email' => 'required'
        ]);

        $user = $this->repository->findBy('email', $request->email)->first();
        if ($user) {
            return response()->json([
                'user' => $user
            ]);
        }

        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
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
            $user = $this->repository->create($data);
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
        $user = $this->repository->find($id);
        if ($user) {
            return response()->json([
                'user' => $user
            ]);
        }

        return response()->json([
                'message' => 'User not found'
            ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string'
        ]);

        try {
            $data = [
                'name' => $request->name,
                'password' => bcrypt($request->password)
            ];

            $this->repository->update($id, $data);

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
            $this->repository->destroy($id);

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
