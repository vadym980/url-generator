<?php

namespace App\Exceptions;

use App\Http\Response\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return ApiResponse::error(
                ErrorCode::VALIDATION_FAILED,
                $exception->validator->errors()->first()
            );
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return ApiResponse::error(
                ErrorCode::HTTP_METHOD_NOT_ALLOWED,
                'Http method not allowed.'
            );
        }

        if ($exception instanceof AuthorizationException) {
            return ApiResponse::forbidden(
                'Forbidden.'
            );
        }

        if ($exception instanceof AuthenticationException) {
            return ApiResponse::unauthenticated();
        }

        // NotFoundHttpException - route doesn't exist
        if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            return ApiResponse::notFound('Resource not found.');
        }

        // if our custom application logic error occurred
        if ($exception instanceof \DomainException) {
            return ApiResponse::error(ErrorCode::VALIDATION_FAILED, $exception->getMessage());
        }

        return parent::render($request, $exception);
    }
}
