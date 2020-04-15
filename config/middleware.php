<?php

declare(strict_types=1);

use Selective\Validation\Encoder\JsonEncoder;
use Selective\Validation\Middleware\ValidationExceptionMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (App $app) {
  // Parse json, form data and xml
  $app->addBodyParsingMiddleware();

  // Add the Slim built-in routing middleware
  $app->addRoutingMiddleware();

  $app->add(new ValidationExceptionMiddleware(
    $app->getResponseFactory(),
    new JsonEncoder()
  ));

  // Catch exceptions and errors
  $app->add(ErrorMiddleware::class);
};
