<?php

namespace Asmthry\PhpQueryBuilder;

use Asmthry\PhpQueryBuilder\MySql\MyQueryBuilder;

abstract class MySql extends MyQueryBuilder
{
    /**
     * If database type is mysql then
     * return [
     *   "host" => "localhost",
     *   "username" => "{Username}",
     *   "password" => "{Password}",
     *   "database" => "{Database name}"
     * ]
     *
     * @return array Database connection details
     */
    abstract protected function database(): array;
}
