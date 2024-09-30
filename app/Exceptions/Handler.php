<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    // إعدادات معالجة الأخطاء الافتراضية

    /**
     * تسجيل استثناءات محددة.
     */
    protected function prepareException(Throwable $exception)
    {
        return parent::prepareException($exception);
    }

    /**
     * إعداد عرض استثناءات.
     */
    public function render($request, Throwable $exception)
    {
        // معالجة استثناء 404
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $exception);
    }
}
