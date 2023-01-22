<?php

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
}
