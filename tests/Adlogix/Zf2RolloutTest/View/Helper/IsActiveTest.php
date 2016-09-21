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

namespace Adlogix\Zf2RolloutTest\View\Helper;

use Adlogix\Zf2Rollout\View\Helper\IsActive;
use Adlogix\Zf2RolloutTest\Util\ServiceManagerFactory;
use Opensoft\Rollout\Rollout;
use Opensoft\Rollout\RolloutUserInterface;
use Zend\View\HelperPluginManager;

class IsActiveTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function invoke_withFeature_callsRolloutAccordingly()
    {
        $rollout = $this->createMock(Rollout::class);

        $rollout->expects($this->once())
            ->method('isActive')
            ->with('a_feature', null)
            ->willReturn(true);


        $helper = new IsActive($rollout);

        $this->assertTrue($helper->__invoke('a_feature'));
    }

    /**
     * @test
     */
    public function invoke_withFeatureAndUser_callsRolloutAccordingly()
    {
        $user = $this->createMock(RolloutUserInterface::class);
        $rollout = $this->createMock(Rollout::class);

        $rollout->expects($this->once())
            ->method('isActive')
            ->with('a_feature', $user)
            ->willReturn(true);


        $helper = new IsActive($rollout);

        $this->assertTrue($helper->__invoke('a_feature', $user));
    }

    /**
     * @test
     */
    public function instantiation_ThroughServiceManager_Working()
    {
        $serviceManager = ServiceManagerFactory::getServiceManager();

        /** @var HelperPluginManager $testing */
        $testing = $serviceManager->get('viewhelpermanager');

        $this->assertTrue($testing->get('rollout_is_active') instanceof IsActive);
    }
}