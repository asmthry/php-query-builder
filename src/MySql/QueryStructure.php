<?php

/*
 * This file is part of the asmthry package.
 *
 * (c) asmthry <asmthry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asmthry\PhpQueryBuilder\MySql;

final class QueryStructure
{
    /**
     * Constant variable to handle select queries
     *
     * @property const SELECT
     */
    public const SELECT = 'SELECT {select} FROM {table}';
}
