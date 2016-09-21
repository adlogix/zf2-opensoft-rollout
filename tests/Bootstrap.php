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

ini_set('error_reporting', E_ALL);

$files = array(__DIR__ . '/../vendor/autoload.php', __DIR__ . '/../../../autoload.php');

foreach ($files as $file) {
    if (file_exists($file)) {
        $loader = require $file;
        break;
    }
}

if (!isset($loader)) {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

/* @var $loader \Composer\Autoload\ClassLoader */
$loader->add('Adlogix\Zf2RolloutTest\\', __DIR__);

/** @noinspection PhpIncludeInspection */
if (!$config = @include __DIR__ . '/TestConfiguration.php') {
    $config = require __DIR__ . '/TestConfiguration.php.dist';
}

\Adlogix\Zf2RolloutTest\Util\ServiceManagerFactory::setConfig($config);