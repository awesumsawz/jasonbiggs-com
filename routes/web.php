<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/web', function () {
    return view('web');
});
Route::get('/resume', function () {
    return view('resume');
});

require __DIR__.'/auth.php';
