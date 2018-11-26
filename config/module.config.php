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

use Adlogix\Zf2Rollout\Service\Controller\RolloutController;

return [

    'rollout' => [

        'user_service' => null,

        'storage_service' => 'zf2_rollout_storage_array',

        'zend_db_storage' => [
            'table_name' => 'rollout_feature'
        ],

        'doctrine_storage' => [
            'class_name' => ''
        ],

        'features' => []
    ],

    'router' => array(
        'routes' => array(
            'rollout_feature_toggle' => array(
                'type' => \Zend\Mvc\Router\Http\Segment::class,
                'options' => array(
                    'route' => '/_rollout_toggle/:feature[/]',
                    'defaults' => array(
                        'controller' => RolloutController::class,
                        'action'     => 'toggleFeature',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'template_map' => [
            'zend-developer-tools/toolbar/rollout' => __DIR__ . '/../view/zend-developer-tools/toolbar/rollout.phtml',
        ],
    ],

    'controllers' => [

        'factories' => [

            RolloutController::class => \Adlogix\Zf2Rollout\Service\Factory\RolloutControllerFactory::class
        ]

    ],

    'service_manager' => [

        'invokables' => [

            'zf2_rollout_storage_array' => Opensoft\Rollout\Storage\ArrayStorage::class

        ],

        'factories' => [

            'zf2_rollout_config' => Adlogix\Zf2Rollout\Service\Factory\ConfigServiceFactory::class,
            'zf2_rollout_storage_factory' => Adlogix\Zf2Rollout\Service\Factory\RolloutStorageFactory::class,
            'zf2_rollout_storage_zend_db' => Adlogix\Zf2Rollout\Service\Factory\RolloutZendDbAdapterStorageFactory::class,
            'zf2_rollout_storage_doctrine' => Adlogix\Zf2Rollout\Service\Factory\DoctrineORMStorageFactory::class,

            'zf2_rollout' => Adlogix\Zf2Rollout\Service\Factory\RolloutFactory::class,
            'zf2_rollout_user' => \Adlogix\Zf2Rollout\Service\Factory\RolloutUserFactory::class,

            'zf2_rollout.toolbar.collector' => \Adlogix\Zf2Rollout\Service\Factory\RolloutCollectorFactory::class

        ]

    ],

    'zenddevelopertools' => [
        'profiler' => [
            'collectors' => [
                'zf2_rollout.toolbar' => 'zf2_rollout.toolbar.collector',
            ],
        ],
        'toolbar' => [
            'entries' => [
                'zf2_rollout.toolbar' => 'zend-developer-tools/toolbar/rollout',
            ],
        ],
    ],

];