<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'view_self_profile']);   
    Route::put('/profile', [ProfileController::class, 'update_self_profile']);   

    Route::get('/dashboard', [DashboardController::class, 'view_dashboard']); 

    Route::get('/profiles', [ProfileController::class, 'list_profiles']);
    Route::get('/profiles/{profile_id}', [ProfileController::class, 'detail_profile']);
    Route::post('/profiles', [ProfileController::class, 'create_profile']);
    Route::put('/profiles/{profile_id}', [ProfileController::class, 'update_profile']);

});
