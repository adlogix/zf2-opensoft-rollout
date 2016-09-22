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

namespace Adlogix\Zf2Rollout\Storage;


use Opensoft\Rollout\Storage\StorageInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\ParameterContainer;

class ZendDbAdapterStorage implements StorageInterface
{
    const STMT_SELECT = 'SELECT settings FROM :table WHERE name = :key';
    const STMT_INSERT = 'INSERT INTO :table (name, settings) VALUES (:key, :value)';
    const STMT_UPDATE = 'UPDATE :table SET settings = :value WHERE name = :key';
    const STMT_DELETE = 'DELETE FROM :table WHERE name = :key';

    private $adapter;

    /**
     * @var string
     */
    private $tableName;

    /**
     * @param Adapter $adapter
     * @param string  $tableName
     */
    public function __construct(Adapter $adapter, $tableName)
    {
        $this->adapter = $adapter;
        $this->tableName = $tableName;
    }

    /**
     * @param  string $key
     *
     * @return string|null Null if the value is not found
     */
    public function get($key)
    {
        $statement = $this->adapter->createStatement($this->getSQLStatement(self::STMT_SELECT),
            new ParameterContainer(['key' => $key]));
        $resultSet = $statement->execute();

        $row = $resultSet->current();

        return (isset($row['settings'])) ? $row['settings'] : null;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function set($key, $value)
    {
        if (null === $this->get($key)) {
            $sql = self::STMT_INSERT;
        } else {
            $sql = self::STMT_UPDATE;
        }
        $statement = $this->adapter->createStatement($this->getSQLStatement($sql),
            new ParameterContainer(['key' => $key, 'value' => $value]));
        $statement->execute();
    }

    /**
     * @param string $key
     *
     * @return void
     */
    public function remove($key)
    {
        $statement = $this->adapter->createStatement($this->getSQLStatement(self::STMT_DELETE),
            new ParameterContainer(['key' => $key]));
        $statement->execute();
    }

    /**
     * @param string $sql
     *
     * @return string
     */
    private function getSQLStatement($sql)
    {
        return str_replace(':table', $this->tableName, $sql);
    }
}