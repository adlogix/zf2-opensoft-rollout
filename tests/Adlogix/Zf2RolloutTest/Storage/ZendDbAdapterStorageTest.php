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

namespace Adlogix\Zf2RolloutTest\Storage;


use Adlogix\Zf2Rollout\Storage\ZendDbAdapterStorage;
use PHPUnit_Framework_TestCase;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\StatementInterface;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\ResultSet\ResultSet;

class ZendDbAdapterStorageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function get_WithValidKey_ReturnsSettings()
    {
        $row['settings'] = 'some_setting';

        $resultSet = $this->createMock(ResultSet::class);
        $resultSet->expects($this->once())
            ->method('current')
            ->willReturn($row);

        $statement = $this->createMock(StatementInterface::class);
        $statement->expects($this->once())
            ->method('execute')
            ->willReturn($resultSet);

        $adapter = $this->createMock(Adapter::class);
        $adapter->expects($this->once())
            ->method('createStatement')
            ->with(str_replace(':table', 'some_table', ZendDbAdapterStorage::STMT_SELECT),
                new ParameterContainer(['key' => 'some_key']))
            ->willReturn($statement);

        $storage = new ZendDbAdapterStorage($adapter, 'some_table');

        $this->assertEquals($row['settings'], $storage->get('some_key'));
    }

    /**
     * @test
     */
    public function set_WithExistingKeyAndSetting_UpdatesCorrectly()
    {
        $row['settings'] = 'some_setting';

        $resultSet = $this->createMock(ResultSet::class);
        $resultSet->expects($this->once())
            ->method('current')
            ->willReturn($row);

        $statement = $this->createMock(StatementInterface::class);
        $statement->expects($this->exactly(2))
            ->method('execute')
            ->willReturn($resultSet);

        $adapter = $this->createMock(Adapter::class);
        $adapter->expects($this->exactly(2))
            ->method('createStatement')
            ->withConsecutive(
                [
                    str_replace(':table', 'some_table', ZendDbAdapterStorage::STMT_SELECT),
                    new ParameterContainer(['key' => 'some_key'])
                ],
                [
                    str_replace(':table', 'some_table', ZendDbAdapterStorage::STMT_UPDATE),
                    new ParameterContainer(['key' => 'some_key', 'value' => 'some_settings'])
                ]
            )
            ->willReturn($statement);

        $storage = new ZendDbAdapterStorage($adapter, 'some_table');

        $storage->set('some_key', 'some_settings');
    }

    /**
     * @test
     */
    public function set_WithNewKeyAndSetting_InsertsCorrectly()
    {
        $row['settings'] = null;

        $resultSet = $this->createMock(ResultSet::class);
        $resultSet->expects($this->once())
            ->method('current')
            ->willReturn($row);

        $statement = $this->createMock(StatementInterface::class);
        $statement->expects($this->exactly(2))
            ->method('execute')
            ->willReturn($resultSet);

        $adapter = $this->createMock(Adapter::class);
        $adapter->expects($this->exactly(2))
            ->method('createStatement')
            ->withConsecutive(
                [
                    str_replace(':table', 'some_table', ZendDbAdapterStorage::STMT_SELECT),
                    new ParameterContainer(['key' => 'some_key'])
                ],
                [
                    str_replace(':table', 'some_table', ZendDbAdapterStorage::STMT_INSERT),
                    new ParameterContainer(['key' => 'some_key', 'value' => 'some_settings'])
                ]
            )
            ->willReturn($statement);

        $storage = new ZendDbAdapterStorage($adapter, 'some_table');

        $storage->set('some_key', 'some_settings');
    }

    /**
     * @test
     */
    public function remove_WithValidKey_Removes()
    {
        $statement = $this->createMock(StatementInterface::class);
        $statement->expects($this->once())
            ->method('execute');

        $adapter = $this->createMock(Adapter::class);
        $adapter->expects($this->once())
            ->method('createStatement')
            ->with(str_replace(':table', 'some_table', ZendDbAdapterStorage::STMT_DELETE),
                new ParameterContainer(['key' => 'some_key']))
            ->willReturn($statement);

        $storage = new ZendDbAdapterStorage($adapter, 'some_table');

        $storage->remove('some_key');
    }
}