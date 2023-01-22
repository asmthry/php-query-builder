<?php

namespace Asmthry\PhpQueryBuilder\Exceptions;

use Exception;

class InvalidDetailsException extends Exception
{
    public function __construct()
    {
        parent::__construct("The given details are invalid");
    }
}
