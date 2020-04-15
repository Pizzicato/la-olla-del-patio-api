<?php

declare(strict_types=1);

namespace App\Action;

use App\Domain\Consumer\Data\ConsumerEditData;
use App\Domain\Consumer\Service\ConsumerEditor;
use App\Domain\ConsumerRole\Data\ConsumerRoleCreateData;
use App\Domain\ConsumerRole\Service\ConsumerRoleCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ConsumerEditAction
{
  private $consumerEditor;
  private $consumerRoleCreator;

  public function __construct(ConsumerEditor $consumerEditor, ConsumerRoleCreator $consumerRoleCreator)
  {
    $this->consumerEditor = $consumerEditor;
    $this->consumerRoleCreator = $consumerRoleCreator;
  }

  public function __invoke(
    ServerRequestInterface $request,
    ResponseInterface $response,
    array $args
  ): ResponseInterface {
    // Fetch parameters from the request
    $id = (int) $args['id'];

    // Create consumer from the HTTP request
    $consumer = new ConsumerEditData((array) $request->getParsedBody());

    // Invoke the Domain with inputs and retain the result
    $this->consumerEditor->editConsumer($id, $consumer);

    // TODO: Check what happens if invalid ids
    foreach ($consumer->roleIds as $roleId) {
      // Create roles for new consumer 
      $consumerRole = new ConsumerRoleCreateData(['roleId' => $roleId, 'consumerId' => $consumer->id]);
      $this->consumerRoleCreator->createConsumerRole($consumerRole);
    }

    // TODO: Logging here: Consumer edited successfully

    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
  }
}
