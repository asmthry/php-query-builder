<?php

/*
 * This file is part of the asmthry package.
 *
 * (c) asmthry <asmthry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asmthry\PhpQueryBuilder;

use Asmthry\PhpQueryBuilder\MySql\QueryBuilder;

abstract class MySql extends QueryBuilder
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

    /**
     * Hide all properties
     */
    public function __debugInfo()
    {
        return [
            'select' => [],
            'where' => []
        ];
    }
}
