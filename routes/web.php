<?php

use Illuminate\Support\Facades\Route;

use App\Models\Pages;
use App\Models\Resume\ProfessionalExperience;
use App\Models\BlogPost;

Route::get('/', function () {
    $slideContent = Pages::where([
        'page_id' => '003',
        'key' => 'slider_content'
    ])->first();

    $textContent = Pages::where([
        'page_id' => '003',
        'key' => 'text_content'
    ])->first();

    return view('home', compact('slideContent', 'textContent'));
});

Route::get('/web', function () {
    $intro = Pages::where([
        'page_id' => '002',
        'key' => 'intro_content'
    ])->first();

    $developmentExamples = Pages::where([
        'page_id' => '002',
        'key' => 'examples_development'
    ])->first();
    $productionSites = Pages::where([
        'page_id' => '002',
        'key' => 'examples_sites'
    ])->first();

    $galleryCards = Pages::where([
        'page_id' => '002',
        'key' => 'gallery_content'
    ])->first();

    return view('web', compact('intro', 'developmentExamples', 'productionSites', 'galleryCards'));
});

Route::get('/resume', function () {
    $professionalExperience = ProfessionalExperience::orderBy('display_order')->get();

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

Route::get('/blog', [App\Http\Controllers\BlogPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [App\Http\Controllers\BlogPostController::class, 'show'])->name('blog.show');
Route::get('/blog-debug/{slug}', [App\Http\Controllers\BlogPostController::class, 'debug'])->name('blog.debug');
Route::get('/image-debug-log', [App\Http\Controllers\BlogPostController::class, 'viewDebugLog'])->name('blog.debuglog');
Route::get('/image-styles/{slug}', [App\Http\Controllers\BlogPostController::class, 'debugImageStyles'])->name('blog.styles');

// Route::get('/contact', function () {
//     return view('contact');
// });
// Route::get('/store', function () {
//     return view('store');
// });
// Route::get('/about', function () {
//     return view('about');
// });
// Route::get('/tech', function () {
//     return view('tech');
// });

// Catch-all route for 404 errors
Route::get('/{any}', function () {
    return view('404');
})->where('any', '.*');