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

namespace Adlogix\Zf2Rollout\Test\Service\Controller;


use Adlogix\Zf2Rollout\Test\Util\ServiceManagerFactory;
use Opensoft\Rollout\Rollout;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

final class RolloutControllerTest extends AbstractHttpControllerTestCase
{
    /**
     * @test
     */
    public function toggleFeatureAction_withValidConfig_shouldExecute()
    {
        ServiceManagerFactory::overrideModuleConfiguration('testing.config-with-override.php');
        $this->setApplicationConfig(ServiceManagerFactory::getConfig());

        $this->dispatch('/_rollout_toggle/some_crazy_feature');
    }
}