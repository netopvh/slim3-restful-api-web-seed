<?php

require_once __DIR__.'/bootstrap/app.php';

$db = $container->get('settings')['db'];

return [
    'paths' => [
        'migrations' => 'app/Migrations',
        'seeds' => 'app/Seeds',
    ],
    'environments' => [
        'default' => [
            'adapter' => $db['driver'],
            'host' => $db['host'],
            'name' => $db['database'],
            'user' => $db['username'],
            'pass' => $db['password'],
        ],
        'default_migration_table' => 'migrations',
    ],
    'migration_base_class' => "App\Migrations\Migration",
    'templates' => [
        'file' => 'resources/templates/Migration.template.php.dist',
    ],
];
