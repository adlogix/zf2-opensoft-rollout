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

namespace Adlogix\Zf2Rollout;


use Opensoft\Rollout\Rollout;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\ServiceManager\AbstractPluginManager;

final class Module implements ConfigProviderInterface, ViewHelperProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * {@inheritdoc}
     */
    public function getViewHelperConfig()
    {
        return [
            'factories' => [
                'rollout_is_active' => function (AbstractPluginManager $pluginManager) {
                    $serviceLocator = $pluginManager->getServiceLocator();
                    /** @var Rollout $rollout */
                    $rollout = $serviceLocator->get('zf2_rollout');
                    return new View\Helper\IsActive($rollout);
                },
                'rollout_description' => function (AbstractPluginManager $pluginManager) {
                    $serviceLocator = $pluginManager->getServiceLocator();
                    $rolloutConfig = $serviceLocator->get('zf2_rollout_config');

                    $features = [];
                    if (isset($rolloutConfig['features'])) {
                        $features = $rolloutConfig['features'];
                    }

                    return new View\Helper\Description($features);
                }
            ],
        ];
    }
}