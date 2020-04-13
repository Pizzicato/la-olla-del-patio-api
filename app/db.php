<?php

declare(strict_types=1);

use DI\Container;
use Illuminate\Database\Capsule\Manager as Capsule;

return function (Container $container) {
  $container->set('db', function ($container) {

    $capsule = new Capsule;
    $capsule->addConnection($container->get('settings')['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
  });
};
