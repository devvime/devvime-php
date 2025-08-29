<?php

require __DIR__ . '/src/server/config/config.php';

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/src/server/database/migration',
            'seeds' => '%%PHINX_CONFIG_DIR%%/src/server/database/seed'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => 'development',
            'development' => [
                'adapter' => $_ENV['DATABASE_TYPE'],
                'host' => '127.0.0.1',
                'name' => $_ENV['DATABASE_NAME'],
                'user' => $_ENV['DATABASE_USER'],
                'pass' => $_ENV['DATABASE_PASSWORD'],
                'port' => 3307,
                'charset' => 'utf8',
            ],
            'testing' => [
                'adapter' => $_ENV['DATABASE_TYPE'],
                'host' => $_ENV['DATABASE_SERVER'],
                'name' => $_ENV['DATABASE_NAME'],
                'user' => $_ENV['DATABASE_USER'],
                'pass' => $_ENV['DATABASE_PASSWORD'],
                'port' => $_ENV['DATABASE_PORT'],
                'charset' => 'utf8',
            ],
            'production' => [
                'adapter' => $_ENV['DATABASE_TYPE'],
                'host' => $_ENV['DATABASE_SERVER'],
                'name' => $_ENV['DATABASE_NAME'],
                'user' => $_ENV['DATABASE_USER'],
                'pass' => $_ENV['DATABASE_PASSWORD'],
                'port' => $_ENV['DATABASE_PORT'],
                'charset' => 'utf8',
            ]
        ],
        'version_order' => 'creation'
    ];
