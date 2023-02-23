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

trait Update
{
    /**
     * Content for updating
     *
     * @var array $update
     */
    private array $update = [];

    /**
     * Create table using array items
     *
     * @param array $values Values to create new row
     */
    public function update(array $values, array $where = [])
    {
        $this->where($where)->setUpdate($values);

        return $this->patch();
    }

    /**
     * This function will return create array
     *
     * @return array create array
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * Add items to update array
     *
     * @param string $values Value for update
     */
    private function setUpdate($values)
    {
        $this->update = $values;
    }
}
