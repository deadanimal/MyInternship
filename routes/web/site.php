<?php

use Illuminate\Support\Facades\Route;

Route::post('/employer-register', [SiteController::class, 'register_employer']);   
Route::post('/worker-register', [SiteController::class, 'register_worker']);   