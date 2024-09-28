<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\payment;
use App\Models\Section;
use App\Models\Comment_Blog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class AdminPageController extends Controller
{

    public static function middleware():array
    {
        return [
            new Middleware('permission:Home', ['only' => ['index']]),
            new Middleware('permission:section', ['only' => ['section_page']]),
            new Middleware('permission:contact_us', ['only' => ['Contact_us_page']]),
            new Middleware('permission:payment_page', ['only' => ['payment']]),
            new Middleware('permission:payment_destroy', ['only' => ['delete_payment']]),
        ];
    }


    public function index(){
        return view('admin.index');
    }

    public function section_page(){
        return view('admin.sections');
    }

    public function Contact_us_page(){
        return view('admin.Contact_us_page');
    }

    public function blog_page(){
        return view('admin.blog_page');
    }
    
    public function show_comment($id){
        $comments = Comment_Blog::where('blog_id', $id)->get();
        return view('admin.show_comment', compact('comments'));
    }
    
    public function payment_page(){
        $payments = payment::paginate(7);
        return view('admin.payment_page',compact('payments'));
    }

    public function payment_destroy(Request $request, $id){
        payment::findorfail($request->id)->delete();
        session()->flash('delete', 'payment delete successfully.');
        return redirect()->back();
    }

}
