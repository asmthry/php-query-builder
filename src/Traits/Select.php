<?php

/*
 * This file is part of the asmthry package.
 *
 * (c) asmthry <asmthry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    /**
     * Add field name to select array
     *
     * @return object $this
     */
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

    /**
     * Get select array
     *
     * @return array
     */
    protected function getSelect(string $default = '*'): array
    {
        return $this->select ? $this->select : [$default];
    }
}
