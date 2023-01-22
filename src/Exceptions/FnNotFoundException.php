<?php

namespace Asmthry\PhpQueryBuilder\Exceptions;

use Exception;

class FnNotFoundException extends Exception
{
    public function __construct($method)
    {
        parent::__construct("Method not found ({$method})");
    }
}
