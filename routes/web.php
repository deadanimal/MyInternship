<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/web/application.php';
require __DIR__.'/web/credit.php';
require __DIR__.'/web/employer.php';
require __DIR__.'/web/internship.php';
require __DIR__.'/web/profile.php';
require __DIR__.'/web/static.php';