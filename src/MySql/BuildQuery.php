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
use Asmthry\PhpQueryBuilder\Helpers\MysqlHelper;
use Asmthry\PhpQueryBuilder\Traits\Select;
use Asmthry\PhpQueryBuilder\Traits\Where;

class BuildQuery extends Connection
{
    use Select;
    use Where;

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
        if (!isset($this->table)) {
            $this->setTable(ClassHelper::classToTable($this));
        }

        return $this->table;
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
    protected function updateQueryString(array $functions)
    {
        foreach ($functions as $key => $fn) {
            $this->replacePlaceHolders(
                $key,
                $this->{$fn}($this->getQueryString())
            );
        }

        return $this;
    }

    /**
     * Set query string parameters
     *
     * @param string|array $value Value for the query param
     */
    protected function setQueryParams($values)
    {
        if (is_array($values)) {
            $this->queryParams = array_merge($this->getQueryParams(), $values);
        } else {
            $this->queryParams[] = $values;
        }
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
     * Replace string place holders
     *
     * @return null
     */
    public function replacePlaceHolders($key, $replaceString)
    {
        return $this->setQueryString(str_replace($key, $replaceString, $this->getQueryString()));
    }

    /**
     * Prepare select statement from select array
     *
     * @return string
     */
    public function prepareSelect()
    {
        return implode(',', $this->getSelect());
    }

    /**
     * Replace all query placeholders and prepare query
     *
     * @return object
     */
    private function prepareQuery()
    {
        return $this->updateQueryString(
            [
                '{select}' => 'prepareSelect',
                '{where}' => 'prepareWhereStatement',
                '{table}' => 'getTable'
            ]
        );
    }

    /**
     * Prepare where statement using array
     *
     * @return string
     */
    private function prepareWhereStatement(): string
    {
        $where = MysqlHelper::prepareWhere($this->getWhere());

        if (array_key_exists('params', $where)) {
            $this->setQueryParams($where['params']);
        }

        return array_key_exists('query', $where) ? $where['query'] : '';
    }
}
