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


use Adlogix\Zf2Rollout\Collector\RolloutCollector;
use Adlogix\Zf2Rollout\Test\Util\ServiceManagerFactory;
use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class RolloutCollectorFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function createService_withValidContainer_shouldReturnRolloutCollectorInstance()
    {
        ServiceManagerFactory::overrideModuleConfiguration('testing.config-with-override.php');

        $collector = ServiceManagerFactory::getServiceManager()
            ->get('zf2_rollout.toolbar.collector');

        $this->assertTrue($collector instanceof RolloutCollector,
            sprintf('Should be instance of %s, but was "%s"', RolloutCollector::class, get_class($collector)));
    }
}