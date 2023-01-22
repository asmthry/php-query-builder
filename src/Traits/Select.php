<?php

namespace Asmthry\PhpQueryBuilder\Traits;

trait Select
{
    private array $select = [];

    /**
     * Select fields from the table
     * You can use {table} to dynamical replace table name
     *
     * @param ...$args Select fields
     */
    public function select(...$args)
    {
        return $this->addToSelect(func_get_args());
    }

    private function addToSelect(array $args)
    {
        foreach ($args as $value) {
            if (is_array($value)) {
                $this->select = array_merge($this->select, $value);
            } else {
                $this->select[] = $value;
            }
        }

        return $this;
    }

    protected function getSelect()
    {
        return implode(',', $this->select);
    }

    protected function replaceSelect(string $query, string $default = '*')
    {
        if (empty($this->select)) {
            $this->select[] = $default;
        }

        return str_replace('{select}', $this->getSelect(), $query);
    }
}
