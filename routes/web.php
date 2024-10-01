<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\InstructorController;

//route view page
Route::controller(UserPageController::class)->group(function (){
    Route::get('/','home')->name('home');
    Route::get('/Courses', 'Courses_page')->name('Courses_page');
    Route::get('/about', 'about_page')->name('about_page');
    Route::get('/blogs', 'blog_page')->name('blog_page');
    Route::get('/blog_details', 'blog_details_page')->name('blog_details_page');
    Route::get('/contact_page', 'contact_page')->name('contact_page');
    Route::get('/single_blog/{id}', 'single_blog_page')->name('single_blog_page');
    Route::get('/save_comment/{id}', 'save_comment')->name('save_comment');
    Route::post('/save_contact', 'save_contact')->name('save_contact');
    Route::get('/single_course/{id}', 'single_course')->name('single_course');
    
});

//route view courses
Route::controller(CourseController::class)->group(function (){

    Route::post('/poststripe/{id}', 'poststripe')->name('poststripe')->middleware('auth');
    Route::get('getstripe', 'getstripe')->name('getstripe')->middleware('auth');
    Route::get('success', 'success')->name('success');
    Route::get('cancel', 'cancel')->name('cancel');
    Route::get('single_section/{id}', 'single_section')->name('single_section');
});


//route admin
Route::controller(AdminPageController::class)->group(function (){
    Route::get('/admin', 'index')->name('admin_index');
    Route::get('/section', 'section_page')->name('section_index');
    Route::get('/Contact_us', 'Contact_us_page')->name('Contact_us');
    Route::get('/blog', 'blog_page')->name('blog_index');
    Route::get('/payment_index', 'payment_page')->name('payment_index');
    Route::delete('/payment_destroy/{id}', 'payment_destroy')->name('payment_destroy');
    Route::get('/show_comment/{id}', 'show_comment')->name('show_comment');
});
//resorce route
Route::resource('/instructor', InstructorController::class);
Route::resource('/course', CourseController::class);

Route::get('auth/google', [GoogleController::class, 'googlepage'])->name('googlepage');
Route::get('google/callback', [GoogleController::class, 'googlecallback'])->name('googlecallback');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//role and permission
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
