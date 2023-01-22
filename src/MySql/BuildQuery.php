<?php

namespace Asmthry\PhpQueryBuilder\MySql;

use Asmthry\PhpQueryBuilder\Helpers\ClassHelper;
use Asmthry\PhpQueryBuilder\Traits\Select;

class BuildQuery extends Connection
{
    use Select;

    /**
     * Name of the table
     *
     * @property $table
     */
    protected $table;

    private function prepareQuery(string $baseQuery)
    {
        $baseQuery = $this->replaceSelect($baseQuery);
        
        return [
            'string' => $this->replaceTableNames($baseQuery),
            'params' => []
        ];
    }

    private function replaceTableNames(string $query)
    {
        if (!$this->table) {
            $this->table = ClassHelper::classToTable($this);
        }

        return str_replace('{table}', $this->table, $query);
    }

    protected function runQuery()
    {
        $query = $this->prepareQuery(QueryStructure::SELECT);

        return $this->executeQuery($query['string'], $query['params']);
    }
}
