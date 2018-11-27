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

namespace Adlogix\Zf2Rollout\Test\View\Helper;

use Adlogix\Zf2Rollout\View\Helper\Description;

/**
 * @package Adlogix\Zf2Rollout\Test\View\Helper
 * @author Laurent De Coninck <laurent@adsdaq.eu>
 */
class DescriptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return Description
     */
    private function createHelper()
    {
        $features = [
            'feature_1' => [
                'description' => 'description for test'
            ],
            'feature_2' => [
            ],
        ];

        return new Description($features);
    }

    /**
     * @test
     */
    public function invoke_WithDescriptions_CorrectDescriptionReturned()
    {
        $this->assertEquals('description for test', $this->createHelper()->__invoke('feature_1'));
    }

    /**
     * @test
     */
    public function invoke_NoDescriptionKey_NullReturned()
    {
        $this->assertEquals('', $this->createHelper()->__invoke('feature_2'));
    }

    /**
     * @test
     */
    public function invoke_NoDescriptionFound_NullReturned()
    {
        $this->assertEquals('', $this->createHelper()->__invoke('feature_3'));
    }
}
