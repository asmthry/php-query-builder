<?php

namespace Asmthry\PhpQueryBuilder\MySql;

class QueryBuilder extends Connection
{
    /**
     * Fetch result from database table
     */
    public static function get()
    {
        return parent::prepareQuery('SELECT * FROM users')->fetchAll();
    }

    /**
     * Fetch result from database table
     */
    public static function first()
    {
        return parent::prepareQuery('SELECT * FROM users')->fetchObject();
    }
}
