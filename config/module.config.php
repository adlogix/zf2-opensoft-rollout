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

    'rollout' => [
        'storage_service' => 'zf2_rollout_storage_array',

        'zend_db_storage' => [
            'table_name' => 'rollout_feature'
        ]
    ],

    'service_manager' => [

        'invokables' => [

            'zf2_rollout_storage_array' => 'Opensoft\Rollout\Storage\ArrayStorage'

        ],

        'factories' => [

            'zf2_rollout_config'          => 'Adlogix\Zf2Rollout\Service\Factory\ConfigServiceFactory',
            'zf2_rollout_storage_factory' => 'Adlogix\Zf2Rollout\Service\Factory\RolloutStorageFactory',
            'zf2_rollout_storage_zend_db' => 'Adlogix\Zf2Rollout\Service\Factory\RolloutZendDbAdapterStorageFactory',

            'zf2_rollout' => 'Adlogix\Zf2Rollout\Service\Factory\RolloutFactory'

        ]

    ]

];