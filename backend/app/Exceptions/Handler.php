<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $this->renderable(function (ClientException $e, Request $request) {
            return response()->json($e->getUserMessage(), $e->getUserCode());
        });

        $this->renderable(function (\Exception $e, Request $request) {
            //Log::error($e->getMessage(), ['trace' => $e->getTrace()]);
            //return response()->json('Oops, there are temporary problems', 500);
        });
    }
}
