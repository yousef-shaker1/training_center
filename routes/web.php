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

Route::get('/', [UserPageController::class, 'home'])->name('home');
Route::get('/Courses', [UserPageController::class, 'Courses_page'])->name('Courses_page');
Route::get('/about', [UserPageController::class, 'about_page'])->name('about_page');
Route::get('/blogs', [UserPageController::class, 'blog_page'])->name('blog_page');
Route::get('/blog_details', [UserPageController::class, 'blog_details_page'])->name('blog_details_page');
Route::get('/contact_page', [UserPageController::class, 'contact_page'])->name('contact_page');
Route::get('/single_blog/{id}', [UserPageController::class, 'single_blog_page'])->name('single_blog_page');
Route::get('/save_comment/{id}', [UserPageController::class, 'save_comment'])->name('save_comment');
Route::post('/save_contact', [UserPageController::class, 'save_contact'])->name('save_contact');
Route::get('/single_course/{id}', [UserPageController::class, 'single_course'])->name('single_course');
Route::post('/poststripe/{id}', [CourseController::class, 'poststripe'])->name('poststripe')->middleware('auth');
Route::get('getstripe', [CourseController::class, 'getstripe'])->name('getstripe')->middleware('auth');
Route::get('success', [CourseController::class, 'success'])->name('success');
Route::get('cancel', [CourseController::class, 'cancel'])->name('cancel');
Route::get('single_section/{id}', [CourseController::class, 'single_section'])->name('single_section');

//admin
Route::get('/admin', [AdminPageController::class, 'index'])->name('admin_index');
Route::get('/section', [AdminPageController::class, 'section_page'])->name('section_index');
Route::get('/Contact_us', [AdminPageController::class, 'Contact_us_page'])->name('Contact_us');
Route::get('/blog', [AdminPageController::class, 'blog_page'])->name('blog_index');
Route::get('/payment_index', [AdminPageController::class, 'payment_page'])->name('payment_index');
Route::delete('/payment_destroy/{id}', [AdminPageController::class, 'payment_destroy'])->name('payment_destroy');
Route::get('/show_comment/{id}', [AdminPageController::class, 'show_comment'])->name('show_comment');
Route::resource('/instructor', InstructorController::class);
Route::resource('/course', CourseController::class);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 
Route::get('auth/google', [GoogleController::class, 'googlepage'])->name('googlepage');
Route::get('google/callback', [GoogleController::class, 'googlecallback'])->name('googlecallback');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
