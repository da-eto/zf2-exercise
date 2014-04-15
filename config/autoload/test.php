<?php
/**
 * Testing Configuration Override
 *
 * This configuration override file is for overriding testing-specific
 * configuration information.
 *
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
            // testing connection name
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'vacancies_test',
                ],
            ],
        ],
    ],
];
