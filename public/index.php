<?php

declare(strict_types=1);

use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();

$settings = require __DIR__ . '/../app/settings.php';
$settings($container);

$db = require __DIR__ . '/../app/db.php';
$db($container);

$a = $container->get('db')->table('grupos')->get();
print_r($a);

$environment = $container->get('settings')['environment'];

// TODO when upload to prod, check if logs are created
if ($environment === 'prod') {
  $logger = require __DIR__ . '/../app/logger.php';
  $logger($container);
}

// Set Container on app
AppFactory::setContainer($container);

// Create App
$app = AppFactory::create();

$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

// Run App
$app->run();
