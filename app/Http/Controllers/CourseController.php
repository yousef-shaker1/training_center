<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Course;
use App\Models\payment;
use App\Models\Section;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Http\Requests\save_course;

use App\Http\Requests\update_course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;

class CourseController extends Controller
{
    public static function middleware():array
    {
        return [
            new Middleware('permission:course', ['only' => ['index']]),
            new Middleware('permission:create_course', ['only' => ['create','store']]),
            new Middleware('permission:edit_course', ['only' => ['edit','update']]),
            new Middleware('permission:delete_course', ['only' => ['destroy']]),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Courses = Course::paginate(5);
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
        $path = $request->img->store('courses', 'public');
        $data = [
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'Numberofhours' => $validatedData['Numberofhours'],
            'Quantity' => $validatedData['Quantity'],
            'type' => $validatedData['type'],
            'section_id' => $validatedData['section_id'],
            'start_data' => $validatedData['start_data'],
            'end_data' => $validatedData['end_data'],
            'img' => $path,
        ];
    
        Course::create($data);
    
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

        payment::create([
            'user_id' => Auth::user()->id,
            'course_id' => $id,
            'created_at' => now(),
        ]);
        
        return redirect()->away($session->url);
        
    } else {
            session()->flash('cancel', 'العدد ممتلئ');
            return redirect()->back();
    }
        
    }

    public function success()
    {
        // try {
        //     // جلب الطلب الأحدث من قاعدة البيانات
        //     $course = Course::latest()->first();
    
        //     // تحقق إذا كان الطلب موجودًا
        //     if (!$course) {
        //         session()->flash('error', 'لم يتم العثور على الطلب.');
        //         return redirect()->back();
        //     }
    
        //     // توليد QR Code
        //     $qrCode = new QrCode('Order ID: ' . $order->id);
        //     $qrCode->setSize(150);
        //     $writer = new PngWriter();
        //     $result = $writer->write($qrCode);
    
        //     // الحصول على محتوى الصورة كـ Base64
        //     $qrCodeImage = base64_encode($result->getString());
    
        //     // إعداد اسم الملف للفاتورة
        //     $filename = 'invoice_' . $order->id . '.pdf';
    
        //     // تحميل العرض
        //     $pdf = Pdf::loadView('invoice', compact('order', 'qrCodeImage'));
        //     return $pdf->download($filename);
    
        // } catch (\Exception $e) {
        //     // إذا حدث خطأ، سيتم تسجيله ويمكنك عرض رسالة خطأ مناسبة
        //     Log::error('Error generating invoice: ' . $e->getMessage());
        //     session()->flash('error', 'حدث خطأ أثناء توليد الفاتورة.');
        //     return redirect()->back();
        // }
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
        $courses = Course::where('section_id', $id)->get();
        return view('user_page.single_section', compact('courses', 'section'));
    }
}
