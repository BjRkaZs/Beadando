<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\WorkerController;
use App\Http\Controllers\api\DepartmentController;
use App\Http\Controllers\api\CityController;
use App\Http\Controllers\api\SpecialityController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get( "/getworkers", [ WorkerController::class, "getWorkers" ]);
Route::get( "/searchworker", [ WorkerController::class, "searchWorker" ] );
Route::post( "/addworker", [ WorkerController::class, "addWorker" ]);
Route::put( "/updateworker", [ WorkerController::class, "updateWorker" ] );
Route::delete( "/deleteworker", [ WorkerController::class, "deleteWorker" ] );

Route::get( "/getdepartments", [ DepartmentController::class, "getDepartments" ]);
Route::get( "/searchdepartment", [ DepartmentController::class, "searchDepartment" ] );
Route::post( "/addepartment", [ DepartmentController::class, "addDepartment" ]);
Route::put( "/updatedepartment", [ DepartmentController::class, "updateDepartment" ] );
Route::delete( "/deletedepartment", [ DepartmentController::class, "deleteDepartment" ] );

Route::get( "/getcities", [ CityController::class, "getCities" ]);
Route::get( "/searchcity", [ CityController::class, "searchCity" ] );
Route::post( "/addcity", [ CityController::class, "addCity" ]);
Route::put( "/updatecity", [ CityController::class, "updateCity" ] );
Route::delete( "/deletecity", [ CityController::class, "deleteCity" ] );

Route::get( "/getspecialities", [ SpecialityController::class, "getSpecialities" ]);
Route::get( "/searchspeciality", [ SpecialityController::class, "searchSpeciality" ] );
Route::post( "/addspeciality", [ SpecialityController::class, "addSpeciality" ]);
Route::put( "/updatespeciality", [ SpecialityController::class, "updateSpeciality" ] );
Route::delete( "/deletespeciality", [ SpecialityController::class, "deleteSpeciality" ] );