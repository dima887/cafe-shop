<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
        ClientException::class,
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (ClientException $e) {
            return response()->json(['error' => $e->getUserMessage()], $e->getUserCode());
        });

        $this->renderable(function (Exception $e) {
            if ($e instanceof ValidationException) {
                $errors = $e->validator->errors()->toArray();
                return response()->json(['errors' => $errors], 422);
            }
            if ($e instanceof AuthenticationException) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            Log::error($e->getMessage(), ['trace' => $e->getTrace()]);
            return response()->json(['error' => 'Oops, there are temporary problems'], 500);
        });
    }
}
