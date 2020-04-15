<?php

declare(strict_types=1);

use Slim\App;

return function (App $app) {
  $app->post('/consumers', \App\Action\ConsumerCreateAction::class);
  $app->put('/consumers/{id}', \App\Action\ConsumerEditAction::class);
};
