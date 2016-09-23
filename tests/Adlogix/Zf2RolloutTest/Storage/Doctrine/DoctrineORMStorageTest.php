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

namespace Adlogix\Zf2RolloutTest\Storage\Doctrine;


use Adlogix\Zf2Rollout\Entity\Feature;
use Adlogix\Zf2Rollout\Storage\Doctrine\DoctrineORMStorage;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use PHPUnit_Framework_TestCase;

class DoctrineORMStorageTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function get_WithValidKey_ReturnsSettings()
    {
        $class = "Feature";

        $repository = $this->createMock(EntityRepository::class);
        $repository->expects($this->once())
            ->method('findOneBy')
            ->with(['name' => 'some_name']);

        $em = $this->createMock(EntityManager::class);
        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($repository)
            ->with($class);

        $storage = new DoctrineORMStorage($em, $class);
        $this->assertNull($storage->get('some_name'));
    }

    /**
     * @test
     */
    public function set_WithExistingKeyAndSetting_UpdatesCorrectly()
    {
        $class = "Feature";

        $feature = new Feature();
        $feature->setName('hello_world');
        $feature->setSettings('some_value');

        $repository = $this->createMock(EntityRepository::class);
        $repository->expects($this->once())
            ->method('findOneBy')
            ->with(['name' => $feature->getName()])
            ->willReturn($feature);

        $em = $this->createMock(EntityManager::class);
        $em->expects($this->once())
            ->method('getRepository')
            ->with($class)
            ->willReturn($repository);

        $em->expects($this->once())
            ->method('persist')
            ->with($feature);
        $em->expects($this->once())
            ->method('flush')
            ->with($feature);

        $storage = new DoctrineORMStorage($em, $class);
        $storage->set($feature->getName(), 'some_new_value');
    }

    /**
     * @test
     */
    public function set_WithNewKeyAndSetting_InsertsCorrectly()
    {
        $class = "Feature";

        $repository = $this->createMock(EntityRepository::class);
        $repository->expects($this->once())
            ->method('findOneBy')
            ->with(['name' => 'some_name'])
            ->willReturn(null);

        $em = $this->createMock(EntityManager::class);
        $em->expects($this->once())
            ->method('getRepository')
            ->with($class)
            ->willReturn($repository);

        $em->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Feature::class));
        $em->expects($this->once())
            ->method('flush')
            ->with($this->isInstanceOf(Feature::class));

        $storage = new DoctrineORMStorage($em, $class);
        $storage->set('some_name', 'some_new_value');
    }

    /**
     * @test
     */
    public function remove_WithValidKey_Removes()
    {
        $class = "Feature";

        $feature = new Feature();
        $feature->setName('hello_world');
        $feature->setSettings('some_value');

        $repository = $this->createMock(EntityRepository::class);
        $repository->expects($this->once())
            ->method('findOneBy')
            ->with(['name' => $feature->getName()])
            ->willReturn($feature);

        $em = $this->createMock(EntityManager::class);
        $em->expects($this->once())
            ->method('getRepository')
            ->with($class)
            ->willReturn($repository);

        $em->expects($this->once())
            ->method('remove')
            ->with($feature);
        $em->expects($this->once())
            ->method('flush')
            ->with($feature);

        $storage = new DoctrineORMStorage($em, $class);
        $storage->remove($feature->getName());
    }
}