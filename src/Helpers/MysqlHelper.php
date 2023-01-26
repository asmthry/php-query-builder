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

        $data = [
            'query' => 'WHERE ',
            'params' => []
        ];
        $count = count($conditions) - 1;

        foreach ($conditions as $key => $item) {
            $isLast = $count > $key && !isset($conditions[$key + 1]['group']);
            self::createWhereCondition($data, $key, $item, $isLast);
        }

        return $data;
    }

    /**
     * Prepare where query string
     *
     * @param array &$data pass the reference of the query string
     * @param string $key Index of current value
     * @param array $item current where array item to prepare query
     * @param bool $isLast do not append AND/OR if query is last
     */
    private static function createWhereCondition(array &$data, string $key, array $item, bool $isLast)
    {
        $index = ":where_{$key}";

        $data['query'] .= "`{$item['field']}`";
        $data['query'] .= QueryConstantsValue::get($item['condition']) . "{$index} ";
        $data['params'][$index] = $item['value'];

        if ($isLast) {
            $data['query'] .= $item['where_type'];
        }
    }

    /**
     * Prepare where group query string
     *
     * @param string &$query pass the reference of the query string
     * @param array $item current where array item to prepare query
     */
    private static function whereGroup(string &$query, array $item)
    {
        if ($item['start']) {
            $query .= empty($item['logic']) ? "(" : " {$item['logic']} (";
        } else {
            $query .=  ")";
        }
    }
}
