<?php

namespace Asmthry\PhpQueryBuilder\Traits;

/**
 * This file is part of the asmthry package.
 *
 * (c) asmthry <asmthry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

trait Create
{
    private array $create = [];
    private static int $_createIndex = 0;
    private static array $_createFields = [];

    public function __set($field, $value)
    {
        $this->setCreate($field, $value);
    }

    private function setCreate($field, $value)
    {
        if (!array_key_exists($field, static::$_createFields)) {
            static::$_createFields[]=$field;
        }
        
        $this->create[static::$_createIndex][$field] = $value;
    }

    public function getCreate()
    {
        return $this->create;
    }

    public function getCreateFields()
    {
        return static::$_createFields;
    }
}
