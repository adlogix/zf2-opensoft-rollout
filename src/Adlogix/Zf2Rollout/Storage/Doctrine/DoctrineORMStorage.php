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

namespace Adlogix\Zf2Rollout\Storage\Doctrine;

use Adlogix\Zf2Rollout\Entity\Feature;
use Doctrine\ORM\EntityManager;
use Opensoft\Rollout\Storage\StorageInterface;
/**
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */
class DoctrineORMStorage implements StorageInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $repository;
    /**
     * @var string
     */
    protected $class;
    /**
     * @param EntityManager $em
     * @param string        $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $this->class = $class;
    }
    /**
     * @param  string     $key
     * @return mixed|null Null if the value is not found
     */
    public function get($key)
    {
        /** @var Feature $feature */
        $feature = $this->repository->findOneBy(array('name' => $key));
        if (!$feature) {
            return null;
        }
        return $feature->getSettings();
    }
    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        /** @var Feature $feature */
        $feature = $this->repository->findOneBy(array('name' => $key));
        if (!$feature) {
            $feature = new Feature();
        }
        $feature->setName($key);
        $feature->setSettings($value);
        $this->em->persist($feature);
        $this->em->flush($feature);
    }
    /**
     * @param string $key
     */
    public function remove($key)
    {
        $feature = $this->repository->findOneBy(array('name' => $key));
        if ($feature) {
            $this->em->remove($feature);
            $this->em->flush($feature);
        }
    }
}