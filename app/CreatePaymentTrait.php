<?php

namespace App;

use App\Models\payment;
use Illuminate\Support\Facades\Auth;

trait CreatePaymentTrait
{
    public function createPayment($courseId) {
        payment::create([
            'user_id' => Auth::user()->id,
            'course_id' => $courseId,
            'created_at' => now(),
        ]);
        
    }
}
