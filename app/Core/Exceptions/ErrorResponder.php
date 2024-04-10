<?php

namespace App\Core\Exceptions;

use App\Domains\Global\Exceptions\DomainException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Client\RequestException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Auth\AuthenticationException;
use Throwable;

final class ErrorResponder
{
    private const VALIDATION_ERROR_KEY = 'fields';
    private static $trace;

    private static $line;

    private static $file;

    private static $result;

    private static $code;

    private static $message;

    public static function handler(Throwable $exception): JsonResponse
    {
        self::$trace = $exception->getTrace();
        self::$file = $exception->getFile();
        self::$line = $exception->getLine();
        self::$message = $exception->getMessage();

        $class = get_class($exception);

        //handle throw_unless And throw_if Responder
        if($class == 'Symfony\Component\HttpKernel\Exception\HttpException'){
            $class = self::$message;
        }

        if($class == 'Symfony\Component\Routing\Exception\RouteNotFoundException')
        {
            $class = $class == empty(request()->bearerToken()) ? AuthenticationException::class : $class;
        }

//        if($class == DomainException::class){
//            $class = RequestException::class;
//            $exception = $exception->getPrevious();
//        }

        //handle throw_unless And throw_if Responder

        return match ($class) {
            ValidationException::class => self::fail(
                422,
                422,
                'the given data was invalid',
                $exception->errors()
            ),
            NotFoundHttpException::class => self::fail(
                404,
                404,
                'page not found'
            ),
            MethodNotAllowedHttpException::class => self::fail(
                405,
                400,
                'method not allowed'
            ),
            ModelNotFoundException::class => self::fail(
                404,
                404,
                'entity not found'
            ),
            QueryException::class => self::fail(
                500,
                400,
                Str::contains($exception->getMessage(), 'Duplicate') ? 'duplicate error' : 'query error'
            // Check Query Exception Error
            ),
            \TypeError::class => self::fail(
                400,
                400,
                'type error'
            ),
            RequestException::class => self::fail(
                422,
                422,
               data_get(json_decode($exception->response->body()),'message')
            ),
            UnauthorizedException::class => self::fail(
                401,
                401,
                'Not Authorized'
            ),
            AuthenticationException::class => self::fail(
                401,
                401,
                'Not Authenticated'
            ),
            DomainException::class => self::fail(
                422,
                400,
                $exception->getMessage(),
                $exception->errors()
            ),

            default => self::fail(
                400,
                400,
                $exception->getMessage()
            ),
        };
    }

    public static function fail(int $status, int $code = 400, ?string $message = null, array $error = []): JsonResponse
    {
        self::$code = $code;

        $locale = trans('messages.'.$message, [], 'fa');
        self::$result['errors'] = [
            'status' => $status,
            'detail' => $message,
            'message' => str_starts_with($locale, 'messages.') ? $message : $locale,
        ];

        if ($error) {
            self::$result['errors'][self::VALIDATION_ERROR_KEY] = $error;
        }

        if (config('app.debug', false)) {
            self::$result['errors']['debug'] = [
                'message' => self::$message,
                'line' => self::$line,
                'file' => self::$file,
                'trace' => collect(self::$trace)->map(function ($trace) {
                    return Arr::except($trace, ['args']);
                })->all(),
            ];
        }

        return self::returner();
    }

    private static function returner(): JsonResponse
    {
        return response()->json(self::$result, self::$code);
    }
}
