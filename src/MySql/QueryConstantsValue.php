<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) asmthry <asmthry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asmthry\PhpQueryBuilder\MySql;

class QueryConstantsValue
{
    /**
     * One value equal to another
     *
     * @var const EQUAL equal mysql statement '='
     */
    public const EQUAL = '=';

    /**
     * One value not equal to another
     *
     * @var const NOTEQUAL equal mysql statement '!='
     */
    public const NOTEQUAL = '!=';

    /**
     * One value must be in an array
     *
     * @var const IN equal mysql statement 'IN'
     */
    public const IN = ' IN ';

    /**
     * One value must not be in an array
     *
     * @var const NOTIN equal mysql statement 'NOT IN'
     */
    public const NOTIN = ' NOT IN ';

    /**
     * Group starting notation
     *
     * @var const START
     */
    public const START = '(';

    /**
     * Group ending notation
     *
     * @var const END
     */
    public const END = ')';

    /**
     * This function will return mysql statement value
     *
     * @param string $const name of the constant
     */
    public static function get(string $const)
    {
        return constant("self::" . $const);
    }
}
