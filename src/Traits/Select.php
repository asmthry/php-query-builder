<?php

namespace Asmthry\PhpQueryBuilder\Traits;

trait Select
{
    private array $select = [];

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

    public function getSelect()
    {
        return implode(',', $this->select);
    }

    public function replaceSelect(string $query, string $default = '*')
    {
        if (empty($this->select)) {
            $this->select[] = '*';
        }

        return str_replace('{select}', $this->getSelect(), $query);
    }
}
