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

namespace Adlogix\Zf2Rollout\Test\Service\Factory;


use Adlogix\Zf2Rollout\Storage\ZendDbAdapterStorage;
use Adlogix\Zf2Rollout\Test\Util\ServiceManagerFactory;
use Opensoft\Rollout\Storage\StorageInterface;
use PHPUnit_Framework_TestCase;

class RolloutZendDbAdapterStorageFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function construction_ThroughServiceManager_Instantiates()
    {
        ServiceManagerFactory::overrideModuleConfiguration('testing.config-with-zend-db-storage.php');

        /** @var StorageInterface $storage */
        $storage = ServiceManagerFactory::getServiceManager()
            ->get('zf2_rollout_storage_factory');

        $this->assertTrue($storage instanceof ZendDbAdapterStorage,
            'Should be instance of ZendDbAdapterStorage, but was "' . get_class($storage) . '"');
    }
}