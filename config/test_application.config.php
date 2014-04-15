<?php

return array_merge_recursive(
    include __DIR__ . '/application.config.php', [
        // redefine some settings to testing
        'module_listener_options' => [
            'config_glob_paths' => [
                'config/autoload/{,*.}{global,local,test}.php',
            ],
        ],
    ]
);