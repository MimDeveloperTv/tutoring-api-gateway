<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UnavailableDomainException extends Exception
{
    protected $message = 'Unavailable Domain';
    protected $code = Response::HTTP_BAD_REQUEST;

    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $message = empty($message) ? $this->message : $message;
        $code = empty($code) ? $this->code : $code;
        parent::__construct($message, $code, $previous);
    }

}
