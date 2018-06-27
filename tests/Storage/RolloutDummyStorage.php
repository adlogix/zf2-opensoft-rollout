<?php
/*
 * This file is part of the Adlogix package.
 *
 * (c) Allan Segebarth <allan@adlogix.eu>
 * (c) Jean-Jacques Courtens <jjc@adlogix.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Adlogix\Zf2Rollout\Test\Storage;


use Opensoft\Rollout\Storage\StorageInterface;

class RolloutDummyStorage implements StorageInterface
{
    /**
     * @param  string $key
     *
     * @return string|null Null if the value is not found
     */
    public function get($key)
    {
        return null;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function set($key, $value)
    {
    }

    /**
     * @param string $key
     *
     * @return void
     */
    public function remove($key)
    {
    }
}