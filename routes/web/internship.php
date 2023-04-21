<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InternshipController;
use App\Http\Controllers\InternshipPostController;

Route::middleware('auth')->group(function () {

    Route::get('/internships', [InternshipController::class, 'list_internships']);
    Route::get('/internships/{internship_id}', [InternshipController::class, 'detail_internship']);
    Route::post('/internships', [InternshipController::class, 'create_internship']);
    Route::put('/internships/{internship_id}', [InternshipController::class, 'update_internship']);

});
