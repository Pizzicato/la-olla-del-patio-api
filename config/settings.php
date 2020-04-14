<?php

declare(strict_types=1);

// Error reporting for production
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Europe/Madrid');

$isLocalhost = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';
$settings['evironment'] = $isLocalhost ? 'dev' : 'prod';

// Error Handling Middleware settings
$settings['error_handler_middleware'] = [
  'display_error_details' => $isLocalhost,
  'log_errors' => true,
  'log_error_details' => true,
];

// Database settings
$settings['db'] = [
  'driver' => 'mysql',
  'database' => 'laOllaDB',
  'host' => 'db',
  'username' => 'user',
  'password' => 'secret',
  'charset' => 'utf8',
  'collation' => 'utf8_unicode_ci',
  'prefix' => '',
  'options' => [
    // Turn off persistent connections
    PDO::ATTR_PERSISTENT => false,
    // Enable exceptions
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // Emulate prepared statements
    PDO::ATTR_EMULATE_PREPARES => true,
    // Set default fetch mode to array
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // Set character set
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_unicode_ci'
  ],
];

return $settings;
