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

    public function __construct()
    {
        $this->middleware('permission:Home')->only(['index']);
        $this->middleware('permission:section')->only(['section_page']);
        $this->middleware('permission:contact_us')->only(['Contact_us_page']);
        $this->middleware('permission:payment_page')->only(['payment']);
        $this->middleware('permission:payment_destroy')->only(['delete_payment']);
    }

    public function index(){
        $courseSalesData = Payment::selectRaw('DATE(created_at) as date, COUNT(course_id) as total_sales')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $courseSalesData->pluck('date')->toArray(); // تواريخ المدفوعات
        $salesData = $courseSalesData->pluck('total_sales')->toArray(); // عدد المدفوعات اليومية

        return view('admin.index', compact('labels', 'salesData'));
        
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
        return view('admin.show_comment', compact('id'));
    }
    
    public function payment_page(){
        $payments = payment::with('course')->paginate(7);
        return view('admin.payment_page',compact('payments'));
    }

    public function payment_destroy(Request $request, $id){
        payment::findorfail($request->id)->delete();
        session()->flash('delete', 'payment delete successfully.');
        return redirect()->back();
    }

}
