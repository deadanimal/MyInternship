<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CreditController;

Route::middleware('auth')->group(function () {

    Route::get('/credits', [CreditController::class, 'list_credits']);
    Route::get('/credits/{credit_id}', [CreditController::class, 'detail_credit']);
    Route::post('/credits', [CreditController::class, 'create_credit']);
    Route::put('/credits/{credit_id}', [CreditController::class, 'update_credit']);

});
