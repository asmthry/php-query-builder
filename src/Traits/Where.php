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

use Asmthry\PhpQueryBuilder\QueryConstants;

trait Where
{
    /**
     * Where Condition array
     *
     * @property array $where - Store where conditions
     */
    private array $where = [];

    /**
     * Prepare Where condition
     *
     * @param array|string $where field name or condition array
     * $where = [{field} => {value}]
     * @param string $value value for the field
     * @return object Will return current instance
     */
    public function where($where, string $value = null)
    {
        return $this->prepareWhereArray($where, QueryConstants::EQUAL, $value);
    }

    /**
     * Prepare Where condition array
     *
     * @param array|string $where field name or condition array
     * $where = [{field} => {value}];
     * @param string $value value for the field
     * @return object Will return current instance
     */
    public function whereNot($where, string $value = null)
    {
        return $this->prepareWhereArray($where, QueryConstants::NOTEQUAL, $value);
    }

    /**
     * Prepare Where IN condition array
     *
     * @param string $field field name
     * @param array $values values needs to check
     * @return object Will return current instance
     */
    public function whereIn(string $field, array $values)
    {
        if (!$values) {
            return $this;
        }

        $this->where[] = [
            "field" => $field,
            "in" => $values,
            "condition" => QueryConstants::IN
        ];

        return $this;
    }

    /**
     * Prepare Where NOT IN condition array
     *
     * @param string $field field name
     * @param array $values values needs to avoid
     * @return object Will return current instance
     */
    public function whereNotIn(string $field, array $values)
    {
        if (!$values) {
            return $this;
        }

        $this->where[] = [
            "field" => $field,
            "in" => $values,
            "condition" => QueryConstants::NOTIN
        ];

        return $this;
    }

    /**
     * Where Condition array
     *
     * @return array Where array
     */
    protected function getWhere()
    {
        return $this->where;
    }

    /**
     * Prepare Where condition array
     *
     * @param array|string $where field name or condition array
     * $where = [{field} => {value}]
     * @param string $condition condition symbol
     * @param string $value value for the field
     * @param string $whereType Where join type
     * @return object $this
     */
    private function prepareWhereArray($where, $condition, string $value = null, string $whereType = 'AND')
    {
        if (!in_array($whereType, ["AND", "OR"])) {
            throw new \Exception("In valid group logic");
        }

        if (is_array($where)) {
            foreach ($where as $key => $value) {
                $this->where[] = [
                    'where_type' => " {$whereType} ",
                    'field' => $key,
                    'value' => $value,
                    'condition' => $condition
                ];
            }
        } else {
            $this->where[] = [
                'where_type' => " {$whereType} ",
                'field' => $where,
                'value' => $value,
                'condition' => $condition
            ];
        }

        return $this;
    }
}
