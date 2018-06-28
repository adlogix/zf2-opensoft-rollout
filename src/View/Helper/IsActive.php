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

namespace Adlogix\Zf2Rollout\View\Helper;

use Opensoft\Rollout\Rollout;
use Opensoft\Rollout\RolloutUserInterface;
use Zend\View\Helper\AbstractHelper;

/**
 * Rollout helper class which will allow in templates to check if
 * a specific feature is active for a given RolloutUserInterface or not.
 *
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
class IsActive extends AbstractHelper
{
    /**
     * @var Rollout
     */
    private $rollout;

    public function __construct(Rollout $rollout)
    {
        $this->rollout = $rollout;
    }

    /**
     * Checks if a feature is active for a given RolloutUserInterface
     *
     * @param string                    $feature
     * @param RolloutUserInterface|null $user
     *
     * @return bool
     */
    public function __invoke($feature, RolloutUserInterface $user = null)
    {
        return $this->rollout->isActive($feature, $user);
    }
}