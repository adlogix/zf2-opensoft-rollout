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

use Opensoft\Rollout\Rollout;
use Opensoft\Rollout\Storage\ArrayStorage;
use Opensoft\Rollout\Storage\RedisStorageAdapter;
use Opensoft\Rollout\Storage\StorageInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RolloutFactory implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var StorageInterface $storage */
        $storage = $serviceLocator->get('zf2_rollout_storage_factory');

        return new Rollout($storage);
    }
}