<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'zenddevelopertools' => [
        'profiler' => [
            'enabled' => false,
        ],
        'toolbar' => [
            'enabled' => false,
        ],
    ],
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'vacancies',
                ],
            ],
        ],
    ],
    'view_manager' => [
        'strategies' => ['ZfcTwigViewStrategy']
    ],
    'zfctwig' => [
        'environment_options' => [
            'cache' => 'data/cache/twig',
        ]
    ],
];

