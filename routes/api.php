<?php

use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\WarehouseKeeper\WarehouseDesignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });
});
Route::apiResource('warehouse-coordinates', WarehouseDesignController::class);
