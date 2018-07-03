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

namespace Adlogix\Zf2Rollout\Service\Factory;


use Adlogix\Zf2Rollout\Service\Controller\RolloutController;
use Interop\Container\ContainerInterface;
use Opensoft\Rollout\Rollout;
use Opensoft\Rollout\RolloutUserInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class RolloutControllerFactory implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, null);
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        /** @var Rollout $rollout */
        $rollout = $container->get('zf2_rollout');

        /** @var RolloutUserInterface $rolloutUser */
        $rolloutUser = $container->get('zf2_rollout_user');

        return new RolloutController($rollout, $rolloutUser);
    }
}
