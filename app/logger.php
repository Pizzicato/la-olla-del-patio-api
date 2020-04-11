<?php

declare(strict_types=1);

use DI\Container;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (Container $container) {
  $container->set(LoggerInterface::class, function (ContainerInterface $container) {
    $settings = $container->get('settings')['logger'];

    $logger = new Logger($settings['name']);

    $processor = new UidProcessor();
    $logger->pushProcessor($processor);

    $handler = new RotatingFileHandler($settings['path'], $settings['maxFiles'], $settings['level']);
    $logger->pushHandler($handler);

    return $logger;
  });
};
