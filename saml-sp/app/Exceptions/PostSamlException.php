<?php

namespace App\Exceptions;

use Exception;

class PostSamlException extends Exception
{
    public array $user;

    public function __construct($temp_user, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $this->user = $temp_user;
        parent::__construct($message, $code, $previous);
    }
}
