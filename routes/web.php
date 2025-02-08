<?php

use Illuminate\Support\Facades\Route;

use App\Models\Resume\Education;
use App\Models\Resume\Skills;
use App\Models\Resume\Professional;
use App\Models\Resume\Personal;


Route::get('/', function () {
    return view('home');
});
Route::get('/web', function () {
    return view('web');
});
Route::get('/resume', function () {
    return view('resume');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/tech', function () {
    return view('tech');
});