<?php

namespace Asmthry\PhpQueryBuilder\Exceptions;

use Exception;

class ItemNotFoundException extends Exception
{
    public function __construct($itemName)
    {
        parent::__construct("{$itemName} is not present in the list");
    }
}
