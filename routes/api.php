<?php

use App\Http\Controllers\Api\MasterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(MasterController::class)->group(function () {
    Route::post('login', 'Login');
    Route::post('addEmployeeFormData', 'addEmployeeForm');
    Route::post('updateEmployeeFormData', 'updateEmployeeForm');
    Route::post('addEmployerFormData', 'addEmployerForm');
    Route::post('updateEmployerFormData', 'updateEmployerForm');
    Route::post('addPostJobFormData', 'addPostJobForm');
    Route::post('getUserData', 'getUserData');
    Route::post('getOtherData', 'getOtherData');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
