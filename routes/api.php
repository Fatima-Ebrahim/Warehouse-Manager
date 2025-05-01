<?php

use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });
});
//    Route::middleware('auth:')->group(function ()
    {
//        Route::apiResource('warehouses', WarehouseController::class)->except(['index',]);
    }
//    );
Route::post('warehouses/store', [WarehouseController::class,'store']);
//Route::apiResource('warehouses', WarehouseController::class)->only(['index',]);
//Route::get('warehouses/type/{type}', [WarehouseController::class, 'byType']);
