<?php

namespace App\Observers;

use App\Models\Course;
use App\Mail\paycourse;
use App\Models\payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentObserver
{
    /**
     * Handle the payment "created" event.
     */
    public function created(payment $payment): void
    {
        $courseId = $payment->course_id;
        $course = Course::findorfail($courseId);
        Mail::to(Auth::user()->email)->send(new paycourse($course));
    }

    /**
     * Handle the payment "updated" event.
     */
    public function updated(payment $payment): void
    {
        //
    }

    /**
     * Handle the payment "deleted" event.
     */
    public function deleted(payment $payment): void
    {
        //
    }

    /**
     * Handle the payment "restored" event.
     */
    public function restored(payment $payment): void
    {
        //
    }

    /**
     * Handle the payment "force deleted" event.
     */
    public function forceDeleted(payment $payment): void
    {
        //
    }
}
