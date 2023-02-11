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
    /**
     * Content for create array
     *
     * @var array $create
     */
    private array $create = [];

    /**
     * Index of the create array
     *
     * @var int $createIndex
     */
    private static int $createIndex = 0;

    /**
     * Array field for create content
     *
     * @var array $createFields
     */
    private static array $createFields = [];

    /**
     * This magic method will set field values
     *
     * @param string $field Name of the field
     * @param string $value Value for the related field
     */
    public function __set($field, $value)
    {
        $this->setCreate($field, $value);
    }

    /**
     * Increase create array index
     *
     * @return $this
     */
    public function createNew()
    {
        static::$createIndex++;

        return $this;
    }

    /**
     * This function will return create array
     *
     * @return array create array
     */
    public function getCreate()
    {
        return $this->create;
    }

    /**
     * This function will return fields
     *
     * @return array
     */
    public function getCreateFields()
    {
        return static::$createFields;
    }

    /**
     * Add items to create array
     *
     * @param string $field Name of the field
     * @param string $value Value for the related field
     */
    private function setCreate($field, $value)
    {
        if (!in_array($field, static::$createFields)) {
            static::$createFields[] = $field;
        }

        $this->create[static::$createIndex][$field] = $value;
    }
}
