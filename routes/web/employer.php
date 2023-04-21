<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployerController;


Route::middleware('auth')->group(function () {

    Route::get('/employers', [EmployerController::class, 'list_employers']);
    Route::get('/employers/{employer_id}', [EmployerController::class, 'detail_employer']);
    Route::post('/employers', [EmployerController::class, 'create_employer']);
    Route::put('/employers/{employer_id}', [EmployerController::class, 'update_employer']);
});
