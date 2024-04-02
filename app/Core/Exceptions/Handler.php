<?php

namespace App\Core\Exceptions;

use App\Core\Exceptions\ErrorResponder as Responder;
use Illuminate\Foundation\Exceptions\Handler as BaseExceptionHandler;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;


class Handler extends BaseExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    /**
     * @param Request $request
     * @param Throwable $e
     * @return JsonResponse
     */
    public function render($request, Throwable $e): JsonResponse
    {
        if ($request->acceptsJson()) {
            return Responder::handler($e);
        }

        return parent::prepareJsonResponse($request, $e);
    }

    /**
     * Prepare a response for the given exception.
     *
     * @param Request $request
     * @param Throwable $e
     * @return Response
     */
    protected function prepareResponse($request, Throwable $e): Response
    {
        $response = new Response(
            $this->renderExceptionWithSymfony($e, config('app.debug', false)),
            $this->isHttpException($e) ? $e->getStatusCode() : 500,
            $this->isHttpException($e) ? $e->getHeaders() : []
        );

        $response->exception = $e;

        return $response;
    }
}
