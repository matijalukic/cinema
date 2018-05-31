<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
