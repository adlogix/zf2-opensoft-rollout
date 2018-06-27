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

namespace Collector;


use Opensoft\Rollout\Rollout;
use Opensoft\Rollout\RolloutUserInterface;
use Zend\Mvc\MvcEvent;
use ZendDeveloperTools\Collector\CollectorInterface;

final class RolloutCollector implements CollectorInterface
{
    /**
     * @var Rollout
     */
    private $rollout;

    /**
     * @var RolloutUserInterface
     */
    private $rolloutUser;

    /**
     * FeatureFlagCollector constructor.
     * @param Rollout              $rollout
     * @param RolloutUserInterface $rolloutUser
     */
    public function __construct(
        Rollout $rollout,
        RolloutUserInterface $rolloutUser
    ) {
        $this->rollout = $rollout;
        $this->rolloutUser = $rolloutUser;
    }

    /**
     * @return array
     */
    public function features()
    {
        $features = [];
        foreach ($this->rollout->features() as $feature) {
            $features[$feature] = $this->rollout->isActive($feature, $this->rolloutUser);
        }

        return $features;
    }


    /**
     * Collector Name.
     *
     * @return string
     */
    public function getName()
    {
        return 'feature-flag';
    }

    /**
     * Collector Priority.
     *
     * @return integer
     */
    public function getPriority()
    {
        return 15;
    }

    /**
     * Collects data.
     *
     * @param MvcEvent $mvcEvent
     */
    public function collect(MvcEvent $mvcEvent)
    {

    }
}