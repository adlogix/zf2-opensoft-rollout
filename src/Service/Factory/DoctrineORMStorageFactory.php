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
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineORMStorageFactory implements FactoryInterface
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
        /** @var EntityManager $em */
        $em = $container->get('doctrine.entitymanager.orm_default');

        /** @var array $rolloutConfig */
        $rolloutConfig = $container->get('zf2_rollout_config');

        if (!isset($rolloutConfig['doctrine_storage']['class_name'])) {
            throw new \RuntimeException('No "[ doctrine_storage => class_name => "some_class"]" defined in the rollout configuration!"');
        }

        $class = $em->getMetadataFactory()->getMetadataFor($rolloutConfig['doctrine_storage']['class_name']);

        /** @noinspection PhpParamsInspection */
        return new DoctrineORMStorage($em, $class);
    }
}