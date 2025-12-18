<?php

use Illuminate\Support\Facades\Route;

use App\Models\Pages;
use App\Models\Resume\ProfessionalExperience;
use App\Models\BlogPost;

Route::get('/', function () {
    $slideContent = Pages::getBySlugAndKey('home', 'slider_content');
    $textContent = Pages::getBySlugAndKey('home', 'text_content');

    return view('home', compact('slideContent', 'textContent'));
});

Route::get('/web', function () {
    $intro = Pages::getBySlugAndKey('web', 'intro_content');
    $developmentExamples = Pages::getBySlugAndKey('web', 'examples_development');
    $productionSites = Pages::getBySlugAndKey('web', 'examples_sites');
    $galleryCards = Pages::getBySlugAndKey('web', 'gallery_content');

    return view('web', compact('intro', 'developmentExamples', 'productionSites', 'galleryCards'));
});

Route::get('/resume', function () {
    $professionalExperience = ProfessionalExperience::all()->sortBy('display_order');

    $intro = Pages::getBySlugAndKey('resume', 'intro_content');
    $education = Pages::getBySlugAndKey('resume', 'education_degree');
    $skillsLanguages = Pages::getBySlugAndKey('resume', 'skills_languages');
    $skillsSystems = Pages::getBySlugAndKey('resume', 'skills_systems');
    $skillsSoftware = Pages::getBySlugAndKey('resume', 'skills_software');
    $personalHobbies = Pages::getBySlugAndKey('resume', 'personal_hobbies');
    $personalProjects = Pages::getBySlugAndKey('resume', 'personal_projects');
    $personalSpeaking = Pages::getBySlugAndKey('resume', 'personal_speaking');

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