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


use Zend\View\Helper\AbstractHelper;

/**
 * Returns the description of a given feature.
 *
 * @package Adlogix\Zf2Rollout\View\Helper
 * @author Laurent De Coninck <laurent@adsdaq.eu>
 */
class Description extends AbstractHelper
{
    /**
     * @var array
     */
    private $features;

    public function __construct(array $features = [])
    {
        $this->features = $features;
    }

    /**
     * Returns the description of a feature.
     *
     * @param string $feature
     *
     * @return string|null
     */
    public function __invoke($feature)
    {
        if (!isset($this->features[$feature]['description'])) {
            return null;
        }

        return $this->features[$feature]['description'];
    }

}