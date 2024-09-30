<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Course;
use App\Models\payment;
use App\Models\Section;
use App\CreatePaymentTrait;
use Illuminate\Http\Request;

use Stripe\Checkout\Session;
use App\Http\Requests\save_course;
use App\Http\Requests\update_course;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    use CreatePaymentTrait;
    public function __construct()
    {
        $this->middleware('permission:course')->only(['index']);
        $this->middleware('permission:create_course')->only(['create', 'store']);
        $this->middleware('permission:edit_course')->only(['edit', 'update']);
        $this->middleware('permission:delete_course')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Courses = Course::with('section')->paginate(5);
        $sections = Section::get();
        $payment = payment::get();
        return view('admin.course_page', compact('Courses','sections', 'payment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(save_course $request)
    {
        $validatedData = $request->validated();

        if (isset($validatedData['img'])) {
            $validatedData['img'] = $request->img->store('courses', 'public');
        }
        
        Course::create($validatedData);
        
        session()->flash('message', 'Instructor created successfully.');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(update_course $request, string $id)
    {
        $Course = Course::findorfail($request->id);
        $data = $request->validated();
        if($request->hasFile('img')){
            if (!empty($Course->img) && Storage::disk('public')->exists($Course->img)) {
                Storage::disk('public')->delete($Course->img);
            }
            $data['img'] = $request->file('img')->store('courses', 'public');
        }else{
            unset($data['img']);
        }
        $Course->update($data);
        session()->flash('message', 'course updated successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $course = Course::findorfail($request->id);
        if(!empty($course->img && Storage::disk('public')->exists($course->img))){
            Storage::disk('public')->delete($course->img);
        }
        $course->delete();
        session()->flash('delete', 'course delete successfully.');
        return redirect()->back();
    }

    public function poststripe($id){
        $course = Course::findorfail($id);
        $pay = payment::where('course_id', $id)->count();
    if($pay < $course->Quantity){

        Stripe::setApiKey(config('services.stripe.secret'));
        
        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Send me money!!',
                        ],
                        'unit_amount' =>$course->price * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
        'cancel_url' => route('cancel'),
        ]);

        $this->createPayment($id);

        return redirect()->away($session->url);
        
    } else {
            session()->flash('cancel', 'العدد ممتلئ');
            return redirect()->back();
    }
        
    }

    public function success()
    {
        session()->flash('message', 'تم حجز اشتراك الكورس .');
        return redirect()->back();
    }
    public function cancel()
    {
        session()->flash('cancel', 'فشلت عملية الدفع');
        return redirect()->back();
    }

    public function single_section($id){
        $section = Section::find($id);
        $courses = Course::with('section')->where('section_id', $id)->get();
        return view('user_page.single_section', compact('courses', 'section'));
    }
}
