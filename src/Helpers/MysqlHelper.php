<?php

/*
 * This file is part of the asmthry package.
 *
 * (c) asmthry <asmthry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asmthry\PhpQueryBuilder\Helpers;

use Asmthry\PhpQueryBuilder\MySql\QueryConstantsValue;

class MysqlHelper
{
    /**
     * Store current loop item index
     *
     * @var int $key
     */
    private static int $key = 0;

    /**
     * Store query data
     *
     * @var array $queryData
     */
    private static array $queryData = [];

    /**
     * Prepare where statement from condition
     *
     * @param array $conditions mysql where conditions array
     * @return array Function will create query and return it
     */
    public static function prepareWhere(array $conditions): array
    {
        if (!$conditions) {
            return [];
        }

        static::$queryData = [
            'query' => 'WHERE ',
            'params' => []
        ];

        foreach ($conditions as $key => $item) {
            static::$key = $key;
            if (array_key_exists('group', $item)) {
                static::createWhereGroupCondition($item);
            } else {
                self::createWhereCondition($item);
            }
        }

        return static::$queryData;
    }

    /**
     * Prepare where query string
     *
     * @param array $item current where array item to prepare query
     * @param bool $isLast do not append AND/OR if query is last
     */
    private static function createWhereCondition(array $item)
    {
        $index = ":where_" . static::$key;

        if (static::$key !== 0) {
            static::$queryData['query'] .= QueryConstantsValue::get($item['where_type']);
        }

        static::$queryData['query'] .= "`{$item['field']}`";

        if (isset($item['in'])) {
            self::createWhereInCondition($item, $index);
        } else {
            static::$queryData['query'] .= QueryConstantsValue::get($item['condition']) . "{$index} ";
            static::$queryData['params'][$index] = $item['value'];
        }
    }

    /**
     * Prepare where query string
     *
     * @param array $item current where array item to prepare query
     * @param string $index Index of current where
     * @param bool $isLast do not append AND/OR if query is last
     */
    private static function createWhereInCondition(array $item, string $index)
    {
        if (!$item['in']) {
            return;
        }

        $data = [];

        foreach ($item['in'] as $key => $value) {
            $data[] = $inIndex = "{$index}_in_$key";
            static::$queryData['params'][$inIndex] = $value;
        }

        static::$queryData['query'] .= QueryConstantsValue::get($item['condition']) .
            "(" . implode(',', $data) . ")";
    }

    /**
     * Prepare where group query string
     *
     * @param string &$query pass the reference of the query string
     * @param array $item current where array item to prepare query
     */
    private static function createWhereGroupCondition(array $item)
    {
        if (!empty($item['logic'])) {
            static::$queryData['query'] .= $item['logic'] . ' ';
        }

        static::$queryData['query'] .= QueryConstantsValue::get($item['group']);
    }

    /**
     * Prepare create query placeholders
     *
     * @param array $items array item to prepare query
     * @return string Create statement value string
     */
    public static function prepareCreatePlaceHolders($items)
    {
        return  '(' . rtrim(str_repeat('?,', count($items)), ',') . '),';
    }
}
