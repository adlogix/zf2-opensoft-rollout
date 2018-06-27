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

namespace Adlogix\Zf2Rollout\Test\Entity;


use Opensoft\Rollout\RolloutUserInterface;

final class User implements RolloutUserInterface
{

    /**
     * @return string
     */
    public function getRolloutIdentifier()
    {
        return 'test';
    }
}