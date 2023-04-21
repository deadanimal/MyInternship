<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

Route::middleware('auth')->group(function () {

    Route::get('/posts', [PostController::class, 'list_posts']);
    Route::get('/posts/{post_id}', [PostController::class, 'detail_post']);
    Route::post('/posts', [PostController::class, 'create_post']);
    Route::put('/posts/{post_id}', [PostController::class, 'update_post']);

});
