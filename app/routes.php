<?php

declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

return function(App $app) {
  $app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('Pollasdaduo');
    return $response;
  });
};