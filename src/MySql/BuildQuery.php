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

use Asmthry\PhpQueryBuilder\Helpers\ClassHelper;
use Asmthry\PhpQueryBuilder\Traits\Select;

class BuildQuery extends Connection
{
    use Select;

    /**
     * Name of the table
     *
     * @property string $table
     */

    protected string $table;
    /**
     * Query string
     *
     * @property string $queryString
     */

    private string $queryString = '';
    /**
     * Params for query preparation
     *
     * @property array $params
     */
    private array $queryParams = [];

    /**
     * Process query
     *
     * @param string $query Query structure to prepare query sting
     */
    protected function runQuery(string $query)
    {
        $this->setQueryString($query);

        return $this->prepareQuery($query)
            ->executeQuery(
                $this->getQueryString(),
                $this->getQueryParams()
            );
    }

    /**
     * Set table name
     *
     * @param string $table Name of the table
     */
    protected function setTable(string $table)
    {
        $this->table = $table;
    }

    /**
     * Get name of the table
     *
     * @return string|null
     */
    protected function getTable()
    {
        return isset($this->table) ? $this->table : null;
    }

    /**
     * Set query string
     *
     * @param string $query Set query string value
     */
    protected function setQueryString(string $query)
    {
        $this->queryString = $query;
    }

    /**
     * Get query string
     *
     * @return string
     */
    protected function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * Update query string
     *
     * @return object $this
     */
    protected function updateQueryString(string $query)
    {
        $this->queryString = $query;

        return $this;
    }

    /**
     * Set query string parameters
     *
     * @param string $value Value for the query param
     */
    protected function setQueryParams(string $value)
    {
        $this->queryParams[] = $value;
    }

    /**
     * Get all params for the query string
     *
     * @return array
     */
    protected function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * Replace all query placeholders and prepare query
     *
     * @return object
     */
    private function prepareQuery()
    {
        return $this->replaceTableNames()
            ->updateQueryString(
                $this->replaceSelect($this->queryString)
            );
    }

    /**
     * Replace table placeholder string {table}
     *
     * @return object
     */
    private function replaceTableNames()
    {
        if (empty($this->getTable())) {
            $this->setTable(ClassHelper::classToTable($this));
        }

        return $this->updateQueryString(
            str_replace(
                '{table}',
                $this->getTable(),
                $this->queryString
            )
        );
    }
}
