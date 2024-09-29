<?php

namespace App\Http\Controllers\api;

use App\Models\payment;
use App\ApirequestTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResponce;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentController extends Controller
{
    use ApirequestTrait;
    public function payment_all(Request $request){
        $payments = PaymentResponce::collection(payment::get());
        return $this->apiResponse($payments, 'ok', 200);
    }

    public function create(Request $request){
        try {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'course_id' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->apiResponse(null, $e->errors(), 400);
        }
        try{
            $payment = payment::create($validatedData);
        } catch(\Exception $e){
            return $this->apiResponse(null, 'payment creation failed', 401);
        }
        return $this->apiResponse(new PaymentResponce($payment), 'create payment success', 200);
    }

    public function delete(Request $request, $id){
        try {
            $payment = payment::where('id', $id)->first();
            $payment->delete();
            return $this->apiResponse(null, 'delete payment success', 200);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse(null, 'payment not found', 404);
        }
    }
}
