<?php

declare(strict_types=1);

namespace App\Action\Consumer;

use App\Domain\Consumer\Data\ConsumerCreateData;
use App\Domain\Consumer\Service\ConsumerCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ConsumerCreateAction
{
  private $consumerCreator;

  public function __construct(ConsumerCreator $consumerCreator)
  {
    $this->consumerCreator = $consumerCreator;
  }

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
  {
    // Create consumer from the HTTP request
    $consumer = new ConsumerCreateData((array) $request->getParsedBody());

    // Invoke the Domain with inputs and retain the result
    $consumerId = $this->consumerCreator->createConsumer($consumer);

    // Transform the result into the JSON representation
    $result = [
      'consumerId' => $consumerId
    ];

    // Build the HTTP response
    $response->getBody()->write((string) json_encode($result));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
  }
}
