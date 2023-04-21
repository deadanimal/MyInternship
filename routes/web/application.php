<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApplicationController;


Route::middleware('auth')->group(function () {

    Route::get('/applications', [ApplicationController::class, 'list_applications']);
    Route::get('/applications/{application_id}', [ApplicationController::class, 'detail_application']);
    Route::post('/applications', [ApplicationController::class, 'create_application']);
    Route::put('/applications/{application_id}', [ApplicationController::class, 'update_application']);
});
