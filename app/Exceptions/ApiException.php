<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    public function __construct(
        string $message,
        int $code = 400,
        mixed $errors = null
    ) {
        parent::__construct($message, $code);
        $this->errors = $errors;
    }

    public mixed $errors;
}
