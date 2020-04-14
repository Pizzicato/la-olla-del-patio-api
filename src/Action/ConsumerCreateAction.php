<?php

declare(strict_types=1);

namespace App\Action;

use App\Domain\Consumer\Data\ConsumerCreateData;
use App\Domain\Consumer\Service\ConsumerCreator;
use App\Domain\ConsumerRole\Data\ConsumerRoleCreateData;
use App\Domain\ConsumerRole\Service\ConsumerRoleCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ConsumerCreateAction
{
  private $consumerCreator;

  public function __construct(ConsumerCreator $consumerCreator, ConsumerRoleCreator $consumerRoleCreator)
  {
    $this->consumerCreator = $consumerCreator;
    $this->consumerRoleCreator = $consumerRoleCreator;
  }

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
  {
    // Create consumer from the HTTP request
    $data = (array) $request->getParsedBody();
    $consumer = new ConsumerCreateData($data);

    // Invoke the Domain with inputs and retain the result
    $consumerId = $this->consumerCreator->createConsumer($consumer);

    
    foreach ($data['roleIds'] as $roleId) {
      // Create roles for new consumer 
      $consumerRole = new ConsumerRoleCreateData(['roleId' => $roleId, 'consumerId' => $consumerId]);
      $this->consumerRoleCreator->createConsumerRole($consumerRole);
    }

    // Transform the result into the JSON representation
    $result = [
      'consumerId' => $consumerId
    ];

    // TODO: Move JSON enconding to a general middleware

    // Build the HTTP response
    $response->getBody()->write((string) json_encode($result));

    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
  }
}
