<?php

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory;
use Selective\Config\Configuration;
use Selective\Validation\Encoder\JsonEncoder;
use Selective\Validation\Middleware\ValidationExceptionMiddleware;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;

return [
  Configuration::class => function () {
    return new Configuration(require __DIR__ . '/settings.php');
  },

  App::class => function (ContainerInterface $container) {
    AppFactory::setContainer($container);
    $app = AppFactory::create();

    // Optional: Set the base path to run the app in a sub-directory
    // The public directory must not be part of the base path
    //$app->setBasePath('/slim4-tutorial');

    return $app;
  },

  ResponseFactoryInterface::class => function (ContainerInterface $container) {
    return $container->get(App::class)->getResponseFactory();
  },

  ErrorMiddleware::class => function (ContainerInterface $container) {
    $app = $container->get(App::class);
    $settings = $container->get(Configuration::class)->getArray('error_handler_middleware');

    return new ErrorMiddleware(
      $app->getCallableResolver(),
      $app->getResponseFactory(),
      (bool) $settings['display_error_details'],
      (bool) $settings['log_errors'],
      (bool) $settings['log_error_details']
    );
  },

  ValidationExceptionMiddleware::class => function (ContainerInterface $container) {
    $factory = $container->get(ResponseFactoryInterface::class);

    return new ValidationExceptionMiddleware($factory, new JsonEncoder());
  },

  // Database connection
  Connection::class => function (ContainerInterface $container) {
    $factory = new ConnectionFactory(new IlluminateContainer());

    $connection = $factory->make($container->get(Configuration::class)->getArray('db'));

    // Disable the query log to prevent memory issues
    $connection->disableQueryLog();

    return $connection;
  },

  PDO::class => function (ContainerInterface $container) {
    return $container->get(Connection::class)->getPdo();
  },

];
