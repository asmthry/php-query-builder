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

/**
 * Use this constant values to perform query
 */
class QueryConstants
{
    /**
     * One value equal to another
     *
     * @var const EQUAL
     */
    public const EQUAL = 'EQUAL';

    /**
     * One value not equal to another
     *
     * @var const NOTEQUAL
     */
    public const NOTEQUAL = 'NOTEQUAL';

    /**
     * One value must be in an array
     *
     * @var const IN
     */
    public const IN = 'IN';

    /**
     * One value must not be in an array
     *
     * @var const NOTIN
     */
    public const NOTIN = 'NOTIN';
}
