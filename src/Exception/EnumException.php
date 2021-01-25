<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class EnumException extends HttpException
{
    public function __construct(string $message = null, int $statusCode = 500, \Exception $previous = null, array $headers = [], ?int $code = 0)
    {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }
}
