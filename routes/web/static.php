<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('static.home');
});

Route::get('/about', function () {
    return view('static.about');
});

Route::get('/privacy', function () {
    return view('static.privacy');
});

Route::get('/terms', function () {
    return view('static.terms');
});