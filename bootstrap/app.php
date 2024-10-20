<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ResponseJson;
use App\Include\ApiFunctions;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;

// EXCEPTIONS
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //$middleware->append(MethodNotAllowedMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (Exception $e, Request $request) {
            if ($request->is('api/*')) {

                if ($e instanceof UnauthorizedHttpException) {

                    $response = ResponseJson::format([], $e->getMessage());
                    return response()->json($response, 401);

                } 
                else if ($e instanceof NotFoundHttpException) {

                    $response = ResponseJson::format([], $e->getMessage());
                    return response()->json($response, 404);

                } 
                // USE IN PRODUCTION
                /* else {
                    
                    $message = ApiFunctions::writeExceptionString($e);

                    Log::channel('log_exceptions')->error($message);

                    $response = ResponseJson::format([], 'Server Error');
                    return response()->json($response, 500);
                } */
            }
        });
    })->create();
