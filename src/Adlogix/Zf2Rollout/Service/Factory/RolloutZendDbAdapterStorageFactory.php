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


use Adlogix\Zf2Rollout\Storage\ZendDbAdapterStorage;
use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RolloutZendDbAdapterStorageFactory implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $rolloutConfig = $serviceLocator->get('zf2_rollout_config');

        if (!isset($rolloutConfig['zend_db_storage']['table_name'])) {
            throw new \RuntimeException('Missing table_name config when using zend db storage!');
        }

        /** @var Adapter $adapter */
        $adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');

        return new ZendDbAdapterStorage($adapter, $rolloutConfig['zend_db_storage']['table_name']);
    }
}