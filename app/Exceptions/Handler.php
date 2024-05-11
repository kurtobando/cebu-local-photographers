<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {});
    }

    public function render($request, Throwable $e): \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
    {
        $response = parent::render($request, $e);

        if (in_array($response->status(), [500, 503, 400, 401, 403, 404])) {
            return Inertia::render('TheExceptionHandler', ['status' => $response->status(), 'message' => $e->getMessage()])
                ->toResponse($request)
                ->setStatusCode($response->status());
        }

        if ($response->status() === 419) {
            return back()->with([
                'message' => 'The page expired, please try again.',
            ]);
        }

        return $response;
    }
}
