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

namespace Adlogix\Zf2RolloutTest\Service\Factory;

use Adlogix\Zf2RolloutTest\Storage\RolloutDummyStorage;
use Adlogix\Zf2RolloutTest\Util\ServiceManagerFactory;
use Opensoft\Rollout\Storage\StorageInterface;
use PHPUnit_Framework_TestCase;

class RolloutStorageFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function construction_ThroughServiceManager_Instantiates()
    {
        $storage = ServiceManagerFactory::getServiceManager()
            ->get('zf2_rollout_storage_factory');

        $this->assertTrue($storage instanceof StorageInterface);
    }

    /**
     * @test
     */
    public function construction_ThroughServiceManagerWithOverriddenStorage_OverridesCorrectly()
    {
        ServiceManagerFactory::overrideModuleConfiguration('testing.config-with-override.php');

        $storage = ServiceManagerFactory::getServiceManager()
            ->get('zf2_rollout_storage_factory');

        $this->assertTrue($storage instanceof RolloutDummyStorage);
    }
}