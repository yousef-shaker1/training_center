<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Course;
use App\Models\contact;
use App\Models\Section;
use App\Models\Instructor;
use App\Http\Requests\save_contact;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function home(){
        $sections = Section::get();
        $courses = Course::take(5)->get();
        $instructors = Instructor::get();
        return view('user_page.home', compact('sections', 'courses', 'instructors'));
    }
    public function Courses_page(){
        $sections = Section::get();
        $courses = Course::take(5)->get();
        return view('user_page.Courses_page', compact('sections', 'courses'));
    }
    public function about_page(){
        $sections = Section::get();
        $instructors = Instructor::get();
        return view('user_page.about_page', compact('sections', 'instructors'));
    }
    public function blog_page(){
        $blogs = Blog::get();
        return view('user_page.blog_page', compact('blogs'));
    }
    public function blog_details_page(){
        return view('user_page.blog_details_page');
    }
    public function contact_page(){
        return view('user_page.contact_page');
    }
    public function single_blog_page($id){
        $blog = Blog::find($id);
        return view('user_page.single_blog_page', compact('blog'));
    }

    public function save_contact(save_contact $request){
            contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
            ]);
            session()->flash('message', 'sand contact success');
            return redirect()->back();
    }

    public function single_course($id){
        $course = Course::findorfail($id);
        return view('user_page.single_course', compact('course'));
    }
}
