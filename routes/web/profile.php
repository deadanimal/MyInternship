<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'view_profile']);   
    Route::put('/profile', [ProfileController::class, 'update_profile']);   

});
