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

namespace Adlogix\Zf2RolloutTest\Service\Factory;


use Adlogix\Zf2Rollout\Service\Factory\DoctrineORMStorageFactory;
use Adlogix\Zf2Rollout\Storage\Doctrine\DoctrineORMStorage;
use Doctrine\ORM\EntityManager;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineORMStorageFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function createService_WithServiceLocator_ReturnsStorage()
    {
        $em = $this->createMock(EntityManager::class);

        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        $serviceLocator->expects($this->at(0))
            ->method('get')
            ->with('doctrine.entitymanager.orm_default')
            ->willReturn($em);

        $serviceLocator->expects($this->at(1))
            ->method('get')
            ->with('zf2_rollout_config')
            ->willReturn(['doctrine_storage' => ['class_name' => 'Feature']]);

        $factory = new DoctrineORMStorageFactory();
        $this->assertInstanceOf(DoctrineORMStorage::class, $factory->createService($serviceLocator));
    }
}