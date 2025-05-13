<?php

use App\Domains\Auth\Controllers\AuthController;
use App\Domains\User\Controllers\UserController;
use App\Domains\User\Resources\UserResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/setLocale', function () {
    $locale = request()->header('Accept-Language', App::getLocale());
    App::setLocale($locale);

    return response()->json([
        'locale' => $locale,
        'messages' => trans('messages'),
    ]);
});

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