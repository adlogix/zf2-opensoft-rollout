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
    'rollout'         => [
        'user_service' => 'zf2_rollout_user',
        'storage_service' => 'zf2_rollout_storage_dummy'
    ],
    'service_manager' => [
        'invokables' => [
            'zf2_rollout_user' => \Adlogix\Zf2Rollout\Test\Entity\User::class,
            'zf2_rollout_storage_dummy' => Adlogix\Zf2Rollout\Test\Storage\RolloutDummyStorage::class
        ]
    ]
];