<?php

// Configure defaults for the whole application.

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['tests'] = $settings['root'] . '/tests';
$settings['public'] = $settings['root'] . '/public';

$settings['error'] = [
    'slashtrace' => 1, // Exibir erros com uma interface gráfica
    'error_reporting' => 1,
    'display_errors' => 1,
    'display_startup_errors' => 1,
];

$settings['timezone'] = 'America/Sao_Paulo';

$settings['view'] = [
    'path' => $settings['root'] . '/resources/views',

    'templates' => [
        "error" => $settings['root'] . '/resources/views/error',
        "console" => $settings['root'] . '/resources/views/console',
        "site" => $settings['root'] . '/resources/views/site',
        "email" => $settings['root'] . '/resources/views/email',
        "layout" => $settings['root'] . '/resources/views/layout',
    ],

    'settings' => [
        'cache' => $settings['root'] . '/storage/cache/views',
        'debug' => true,
        'auto_reload' => true,
    ],
];

$settings['database'] = [
    'sqlite' => [
        'driver' => 'sqlite',
        'host' => 'localhost',
        'database' =>  $settings['root'] . '/storage/database/db.sqlite',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]
];

return $settings;