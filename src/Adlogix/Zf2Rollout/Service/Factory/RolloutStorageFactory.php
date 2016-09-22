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


use Opensoft\Rollout\Storage\StorageInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RolloutStorageFactory implements FactoryInterface
{
    private static $storage_service = 'storage_service';

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var array $config */
        $config = $serviceLocator->get('zf2_rollout_config');

        if (!isset($config[self::$storage_service]) || $config[self::$storage_service] === '') {
            throw new \RuntimeException('No "' . self::$storage_service . '" defined in the rollout configuration!"');
        }

        $storage = $serviceLocator->get($config[self::$storage_service]);

        if (!$storage instanceof StorageInterface) {
            throw new \RuntimeException(sprintf('The "' . self::$storage_service . '" should be an instance of StorageInterface but was %s',
                get_class($storage)));
        }

        return $storage;
    }
}