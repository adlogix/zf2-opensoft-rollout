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

namespace Adlogix\Zf2RolloutTest\Util;

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

class ServiceManagerFactory
{
    /**
     * @var array
     */
    protected static $config;

    /**
     * @param array $config
     */
    public static function setConfig(array $config)
    {
        static::$config = $config;
    }

    /**
     * Config file name set in the tests directory that needs to override the predefined one
     *
     * @param string $configFile
     */
    public static function overrideModuleConfiguration($configFile)
    {
        $configFilePath = __DIR__ . '/../../../' . $configFile;
        if (!file_exists($configFilePath)) {
            throw new \RuntimeException(sprintf('The config file "%s" does not exist', $configFilePath));
        }

        static::$config['module_listener_options']['config_glob_paths'] = [$configFilePath];
    }

    /**
     * Builds a new service manager
     */
    public static function getServiceManager()
    {
        $serviceManager = new ServiceManager(new ServiceManagerConfig(
            isset(static::$config['service_manager']) ? static::$config['service_manager'] : array()
        ));
        $serviceManager->setService('ApplicationConfig', static::$config);
        /** @var $moduleManager \Zend\ModuleManager\ModuleManager */
        $moduleManager = $serviceManager->get('ModuleManager');
        $moduleManager->loadModules();

        return $serviceManager;
    }

}