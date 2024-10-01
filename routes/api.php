<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BlogController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CourseController;
use App\Http\Controllers\api\PaymentController;
use App\Http\Controllers\api\SectionController;
use App\Http\Controllers\api\InstructorController;
use App\Http\Controllers\api\Customer_messagesController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::post('auth/google', [UserController::class, 'googlepage']);
Route::get('google/callback', [UserController::class, 'googlecallback']);

Route::group(['middleware' => ['jwt.verify']], function() {
    //jwt
    Route::get('profile', [UserController::class,'profile']);
    Route::get('logout', [UserController::class,'logout']);
    Route::post('/refresh', [UserController::class, 'refresh']);
    
    //sections
    Route::get('/sections', [SectionController::class, 'section_all']);
    Route::get('/section/{id}', [SectionController::class, 'show_section']);
    Route::post('/create/section', [SectionController::class, 'create']);
    Route::post('/edit/section/{id}', [SectionController::class, 'edit']);
    Route::delete('/delete/section/{id}', [SectionController::class, 'delete']);
    
    //payment
    Route::get('/payments', [PaymentController::class, 'payment_all']);
    Route::post('/create/payment', [PaymentController::class, 'create']);
    Route::delete('/delete/payment/{id}', [PaymentController::class, 'delete']);
    
    //love blog
    Route::get('/create/love_blog/{id}', [BlogController::class, 'create_love']);
    Route::delete('/delete/love_blog/{id}', [BlogController::class, 'delete_love']);

    //blog
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/blog/{id}', [BlogController::class, 'show_blog']);
    Route::post('/create/blog', [blogController::class, 'create']);
    Route::post('/edit/blog/{id}', [blogController::class, 'edit']);
    Route::delete('/delete/blog/{id}', [blogController::class, 'delete']);
    
    //comment blog
    Route::get('/comment_blogs/{id}', [BlogController::class, 'comment_blogs']);
    Route::post('/create/comment/{id}', [BlogController::class, 'create_comment']);
    Route::delete('/delete/comment_blog/{id}', [blogController::class, 'delete_comment_blog']);
    
    //Contact_us
    Route::get('/messages', [Customer_messagesController::class, 'index']);
    Route::post('/create/message', [Customer_messagesController::class, 'create_message']);
    Route::delete('/delete/message/{id}', [Customer_messagesController::class, 'delete']);

    //instructors
    Route::get('/instructors', [InstructorController::class, 'instructor_all']);
    Route::get('/instructor/{id}', [InstructorController::class, 'show_instructor']);
    Route::post('/create/instructor', [InstructorController::class, 'create']);
    Route::post('/edit/instructor/{id}', [InstructorController::class, 'edit']);
    Route::delete('/delete/instructor/{id}', [InstructorController::class, 'delete']);

    //courses
    Route::get('/courses', [CourseController::class, 'course_all']);
    Route::get('/course/{id}', [CourseController::class, 'show_course']);
    Route::post('/create/course', [CourseController::class, 'create']);
    Route::post('/edit/course/{id}', [CourseController::class, 'edit']);
    Route::delete('/delete/course/{id}', [CourseController::class, 'delete']);
    
});