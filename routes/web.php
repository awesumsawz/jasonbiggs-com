<?php

use Illuminate\Support\Facades\Route;

use App\Models\Pages;
use App\Models\Resume\ProfessionalExperience;

Route::get('/', function () {
    return view('home');
});
Route::get('/web', function () {
    return view('web');
});
Route::get('/resume', function () {
    $professionalExperience = ProfessionalExperience::all();

    $intro = Pages::where([
        'page_id' => '001',
        'key' => 'intro_content'
    ])->first();

    $education = Pages::where([
        'page_id' => '001',
        'key' => 'education_degree'
    ])->first();
    
    $skillsLanguages = Pages::where([
        'page_id' => '001',
        'key' => 'skills_languages'
    ])->first();
    $skillsSystems = Pages::where([
        'page_id' => '001',
        'key' => 'skills_systems'
    ])->first();
    $skillsSoftware = Pages::where([
        'page_id' => '001',
        'key' => 'skills_software'
    ])->first();

    $personalHobbies = Pages::where([
        'page_id' => '001',
        'key' => 'personal_hobbies'
    ])->first();
    $personalProjects = Pages::where([
        'page_id' => '001',
        'key' => 'personal_projects'
    ])->first();
    $personalSpeaking = Pages::where([
        'page_id' => '001',
        'key' => 'personal_speaking'
    ])->first();

    return view('resume', compact('intro', 'education', 'skillsLanguages', 'skillsSystems', 'skillsSoftware', 'personalHobbies', 'personalProjects', 'personalSpeaking', 'professionalExperience'));
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/tech', function () {
    return view('tech');
});