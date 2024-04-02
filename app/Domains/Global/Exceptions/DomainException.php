<?php

namespace App\Domains\Global\Exceptions;

use Exception;

class DomainException extends Exception
{
    private ?array $errors;

    /**
     * ServiceException constructor.
     *
     * @param  int  $code
     * @param  array|null  $errors
     * @param  Exception|null  $previous
     */
    public function __construct($code = 0, ?array $errors = null, Exception $previous = null)
    {
        parent::__construct('http call request', $code, $previous);

        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }
}
