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

return [

    'db' => [
        'driver'   => 'pdo',
        'dsn'      => 'mysql:dbname=demo;host=localhost',
        'username' => 'root',
        'password' => ''
    ],

    'rollout' => [
        'storage_service' => 'zf2_rollout_storage_zend_db'
    ],

    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter' => Zend\Db\Adapter\AdapterServiceFactory::class
        ],
    ]
];