<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // Add this method to handle JSON response for API exceptions:
    public function render($request, Throwable $exception)
    {
        // If the request expects JSON (API)
        if ($request->expectsJson()) {
            $status = 500;
            $message = 'Server Error';

            if ($exception instanceof ValidationException) {
                $status = 422;
                $message = $exception->validator->errors()->first();
            } elseif ($exception instanceof AuthenticationException) {
                $status = 401;
                $message = 'Unauthenticated';
            } elseif (method_exists($exception, 'getStatusCode')) {
                $status = $exception->getStatusCode();
                $message = $exception->getMessage();
            } else {
                $message = $exception->getMessage();
            }

            return response()->json([
                'success' => false,
                'message' => $message
            ], $status);
        }

        // Default rendering (for web requests)
        return parent::render($request, $exception);
    }
}
