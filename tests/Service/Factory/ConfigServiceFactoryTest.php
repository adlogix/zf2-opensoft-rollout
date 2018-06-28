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

use Adlogix\Zf2Rollout\Test\Util\ServiceManagerFactory;
use PHPUnit_Framework_TestCase;

class ConfigServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function construction_ThroughServiceManager_Instantiates()
    {
        $config = ServiceManagerFactory::getServiceManager()
            ->get('zf2_rollout_config');

        $this->assertTrue(array_key_exists('storage_service', $config));
    }
}