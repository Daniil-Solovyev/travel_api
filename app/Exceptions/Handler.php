<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @return bool
     */
    protected function isApiCall($request)
    {
        return strpos($request->getUri(), '/api/') !== false;
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function render($request, Exception|Throwable $e)
    {
        if (! $this->isApiCall($request)) {
            return parent::render($request, $e);
        }

        if ($e instanceof ValidationException) {
            return response()->json(['data' => [], 'message' => 'Validation error', 'errors' => $e->validator->getMessageBag()->toArray()], 422);
        } elseif ($e instanceof Exception) {
            return response()->json(['message' => $e->getMessage()], '500');
        }

        return parent::render($request, $e);
    }
}
