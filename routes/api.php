<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  $user = $request->user()->load('modules');
  return new UserResource($user);
}); */


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
      $user = $request->user()->load('modules');
      return new UserResource($user);
    });
});

Route::group(['middleware' => 'auth:sanctum'], function() {
  Route::apiResource('users', UserController::class);
});