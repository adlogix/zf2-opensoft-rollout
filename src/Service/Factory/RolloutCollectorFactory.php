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

use Collector\RolloutCollector;
use Interop\Container\ContainerInterface;
use Opensoft\Rollout\Rollout;
use Opensoft\Rollout\RolloutUserInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class RolloutCollectorFactory implements FactoryInterface
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
        /** @var array $config */
        $config = $container->get('zf2_rollout_config');


        /** @var Rollout $rollout */
        $rollout = $container->get('zf2_rollout');

        if (!$container->has($config['user'])) {
            throw new ServiceNotCreatedException(sprintf('You must define a service for %s', $config['user']));
        }

        /** @var RolloutUserInterface $rolloutUser */
        $rolloutUser = $container->get($config['user']);

        return new RolloutCollector($rollout, $rolloutUser);
    }
}
