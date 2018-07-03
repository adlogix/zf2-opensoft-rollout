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
use PHPUnit\Framework\TestCase;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class RolloutUserFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function createService_withoutRolloutUserServiceDefined_shouldThrowExplicitException()
    {
        ServiceManagerFactory::overrideModuleConfiguration('testing.config.php');

        try {

            ServiceManagerFactory::getServiceManager()
                ->get('zf2_rollout_user');
            $this->fail('should have raised an exception');
        } catch (\Exception $exception) {
            $this->assertEquals('You must define a service for rollout user_service.',
                $exception->getPrevious()->getMessage());
        }
    }
}