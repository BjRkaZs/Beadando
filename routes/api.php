<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\WorkerController;
use App\Http\Controllers\api\DepartmentController;
use App\Http\Controllers\api\CityController;
use App\Http\Controllers\api\PositionController;
use App\Http\Controllers\api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post( "/register", [ UserController::class, "register" ] );
Route::post( "/login", [ UserController::class, "login" ] );
Route::post( "/logout", [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::get( "/getworkers", [ WorkerController::class, "getWorkers" ]);
Route::get( "/searchworker", [ WorkerController::class, "searchWorker" ] );
Route::post( "/addworker", [ WorkerController::class, "addWorker" ]);
Route::put( "/updateworker", [ WorkerController::class, "updateWorker" ] );
Route::delete( "/deleteworker", [ WorkerController::class, "deleteWorker" ] );

Route::get( "/getcities", [ CityController::class, "getCities" ]);

Route::get( "/getdepartments", [ DepartmentController::class, "getDepartments" ]);

Route::get( "/getpositions", [ PositionController::class, "getPositions" ]);
