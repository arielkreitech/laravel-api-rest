<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signUp']);

    Route::group([
      'middleware' => 'auth:sanctum'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

Route::group([
    'middleware' => 'auth:sanctum'
  ], function() {

    //Routes CRUD User
    Route::apiResource('users', UserController::class);
    Route::get('user_by_email', [UserController::class, 'getUserByEmail']);

  });
