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


use Adlogix\Zf2Rollout\Storage\Doctrine\DoctrineORMStorage;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineORMStorageFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var EntityManager $em */
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');

        /** @var array $rolloutConfig */
        $rolloutConfig = $serviceLocator->get('zf2_rollout_config');

        if (!isset($rolloutConfig['doctrine_storage']['class_name'])) {
            throw new \RuntimeException('No "[ doctrine_storage => class_name => "some_class"]" defined in the rollout configuration!"');
        }

        return new DoctrineORMStorage($em, $rolloutConfig['doctrine_storage']['class_name']);
    }
}