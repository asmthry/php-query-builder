<?php

namespace Asmthry\PhpQueryBuilder\MySql;

class QueryBuilder extends BuildQuery
{
    /**
     * Fetch result from database table
     */
    public function get()
    {
        return $this->runQuery(QueryStructure::SELECT)->fetchObject();
    }

    /**
     * Fetch result from database table
     */
    public function first()
    {
        return $this->runQuery(QueryStructure::SELECT)->fetchObject();
    }
}
