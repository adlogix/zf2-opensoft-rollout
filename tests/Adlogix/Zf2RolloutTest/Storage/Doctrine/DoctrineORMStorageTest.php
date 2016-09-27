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


use Adlogix\Zf2Rollout\Storage\Doctrine\DoctrineORMStorage;
use Adlogix\Zf2RolloutTest\Entity\Feature;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use PHPUnit_Framework_TestCase;

class DoctrineORMStorageTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function get_WithValidKey_ReturnsSettings()
    {
        $class = $this->createMock(ClassMetadata::class);

        $em = $this->createMock(EntityManager::class);

        $storage = $this->getMockBuilder(DoctrineORMStorage::class)
            ->setConstructorArgs([$em, $class])
            ->setMethods(['findOneBy'])
            ->getMock();

        $storage->expects($this->once())
            ->method('findOneBy')
            ->with(['name' => 'some_name']);

        $this->assertNull($storage->get('some_name'));
    }

    /**
     * @test
     */
    public function set_WithExistingKeyAndSetting_UpdatesCorrectly()
    {
        $class = $this->createMock(ClassMetadata::class);

        $em = $this->createMock(EntityManager::class);

        $feature = new Feature();
        $feature->setName('some_name');
        $feature->setSettings('some_value');

        $storage = $this->getMockBuilder(DoctrineORMStorage::class)
            ->setConstructorArgs([$em, $class])
            ->setMethods(['findOneBy', 'getClassName'])
            ->getMock();

        $storage->expects($this->once())
            ->method('findOneBy')
            ->with(['name' => 'some_name'])
            ->willReturn($feature);

        $em->expects($this->once())
            ->method('persist')
            ->with($feature);
        $em->expects($this->once())
            ->method('flush')
            ->with($feature);

        /** @var DoctrineORMStorage $storage */
        $storage->set($feature->getName(), 'some_new_value');
    }

    /**
     * @test
     */
    public function set_WithNewKeyAndSetting_InsertsCorrectly()
    {
        $class = $this->createMock(ClassMetadata::class);

        $em = $this->createMock(EntityManager::class);

        $storage = $this->getMockBuilder(DoctrineORMStorage::class)
            ->setConstructorArgs([$em, $class])
            ->setMethods(['findOneBy', 'getClassName'])
            ->getMock();

        $storage->expects($this->once())
            ->method('findOneBy')
            ->with(['name' => 'some_name']);

        $storage->expects($this->once())
            ->method('getClassName')
            ->willReturn(Feature::class);

        $em->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Feature::class));
        $em->expects($this->once())
            ->method('flush')
            ->with($this->isInstanceOf(Feature::class));

        /** @var DoctrineORMStorage $storage */
        $storage->set('some_name', 'some_new_value');
    }

    /**
     * @test
     */
    public function remove_WithValidKey_Removes()
    {
        $class = $this->createMock(ClassMetadata::class);

        $em = $this->createMock(EntityManager::class);

        $feature = new Feature();
        $feature->setName('some_name');
        $feature->setSettings('some_value');

        $storage = $this->getMockBuilder(DoctrineORMStorage::class)
            ->setConstructorArgs([$em, $class])
            ->setMethods(['findOneBy'])
            ->getMock();

        $storage->expects($this->once())
            ->method('findOneBy')
            ->with(['name' => 'some_name'])
            ->willReturn($feature);

        $em->expects($this->once())
            ->method('remove')
            ->with($feature);
        $em->expects($this->once())
            ->method('flush')
            ->with($feature);

        /** @var DoctrineORMStorage $storage */
        $storage->remove($feature->getName());
    }
}