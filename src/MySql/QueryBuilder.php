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

class QueryBuilder extends BuildQuery
{
    /**
     * Fetch result from database table
     */
    public function get()
    {
        return $this->runQuery(QueryStructure::SELECT)->fetchAll();
    }

    /**
     * Fetch result from database table
     */
    public function first()
    {
        return $this->runQuery(QueryStructure::SELECT)->fetchObject();
    }

    /**
     * Set custom table name
     *
     * @param string $table Name of the table
     */
    public function from(string $table)
    {
        $this->setTable($table);

        return $this;
    }

    /**
     * Save create data
     *
     * @return $this
     */
    public function save()
    {
        return $this->runQuery(QueryStructure::CREATE);
    }

    /**
     * Update data
     *
     * @return $this
     */
    public function patch()
    {
        return $this->runQuery(QueryStructure::UPDATE);
    }
}
