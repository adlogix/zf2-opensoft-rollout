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

namespace Adlogix\Zf2Rollout\Service\Controller;

use Opensoft\Rollout\Rollout;
use Opensoft\Rollout\RolloutUserInterface;
use Zend\Http\Header\Referer;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * @author Toni Van de Voorde <toni@adlogix.eu>
 */
final class RolloutController extends AbstractActionController
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
     * @return \Zend\Http\Response
     */
    public function toggleFeatureAction()
    {
        $feature = $this->params()->fromRoute('feature');

        if ($this->rollout->isActive($feature, $this->rolloutUser)) {
            $this->rollout->deactivateUser($feature, $this->rolloutUser);
        } else {
            $this->rollout->activateUser($feature, $this->rolloutUser);
        }

        return $this->redirect()->toUrl($this->getRefererUri());
    }

    /**
     * @return string The referer URI (if not available returns '/' )
     */
    protected function getRefererUri()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        $headers = $request->getHeader('Referer', '/');

        return $headers instanceof Referer ? $headers->getUri() : (string)$headers;
    }
}