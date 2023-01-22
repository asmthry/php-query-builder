<?php

/*
 * This file is part of the asmthry package.
 *
 * (c) asmthry <asmthry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asmthry\PhpQueryBuilder\Helpers;

class ClassHelper
{
    /**
     * Convert fully coalified class name to table name
     *
     * @return string Name of the table
     */
    public static function classToTable(object $class)
    {
        $class = explode("\\", get_class($class));

        return strtolower(end($class));
    }
}
