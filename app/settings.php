<?php

declare(strict_types=1);

use DI\Container;
use Monolog\Logger;

return function (Container $container) {
  $container->set('settings', function () {
    
    $isLocalhost = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;

    return [
      'name' => 'La Olla del patio backend',
      'environment' => $isLocalhost ? 'dev' : 'prod',
      'displayErrorDetails' => $isLocalhost,
      'logErrors' => true,
      'logErrorDetails' => true,
      'logger' => [
        'name' => 'la-olla-del-patio-app-be',
        'path' => __DIR__ . '/../logs/olla.log',
        'level' => Logger::DEBUG,
        'maxFiles' => 200,
      ],
      'db' => [
        'driver'    => 'mysql',
        'host'      => 'db',
        'database'  => 'laollad1_DB',
        'username'  => 'user',
        'password'  => 'secret',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
      ],
    ];
  });
};
