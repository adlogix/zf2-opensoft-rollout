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

use Adlogix\Zf2Rollout\Entity\FeatureInterface;
use Doctrine\ORM\EntityRepository;
use Opensoft\Rollout\Storage\StorageInterface;

/**
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */
class DoctrineORMStorage extends EntityRepository implements StorageInterface
{
    /**
     * @param  string $key
     *
     * @return mixed|null Null if the value is not found
     */
    public function get($key)
    {
        /** @var FeatureInterface $feature */
        $feature = $this->findOneBy(array('name' => $key));
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
        /** @var FeatureInterface $feature */
        $feature = $this->findOneBy(array('name' => $key));
        if (!$feature) {
            $className = $this->getClassName();
            $feature = new $className();
        }
        $feature->setName($key);
        $feature->setSettings($value);
        $this->_em->persist($feature);
        $this->_em->flush($feature);
    }

    /**
     * @param string $key
     */
    public function remove($key)
    {
        $feature = $this->findOneBy(array('name' => $key));
        if ($feature) {
            $this->_em->remove($feature);
            $this->_em->flush($feature);
        }
    }
}