<?php

declare(strict_types=1);

namespace App\Domain\Consumer\Service;

use App\Domain\Consumer\Data\ConsumerCreateData;
use App\Domain\Consumer\Repository\ConsumerCreatorRepository;
use App\Domain\Consumer\Validator\ConsumerCreateValidator;
use Selective\Validation\Exception\ValidationException;

/**
 * Service.
 */
final class ConsumerCreator
{
  /**
   * @var ConsumerCreatorRepository
   */
  private $repository;

  /**
   * @var ConsumerCreateValidator
   */
  protected $validator;

  /**
   * @var LoggerInterface
   */
  private $logger;

  /**
   * The constructor.
   *
   * @param ConsumerCreatorRepository $repository The repository
   */
  public function __construct(
    ConsumerCreatorRepository $repository,
    ConsumerCreateValidator $validator
    )
  {
    $this->repository = $repository;
    $this->validator = $validator;
  }

  /**
   * Create a new consumer.
   *
   * @param ConsumerCreateData $consumer The consumer data
   *
   * @throws InvalidArgumentException
   *
   * @return int The new consumer ID
   */
  public function createConsumer(ConsumerCreateData $consumer): int
  {
    // Validation
    $validation = $this->validator->validateConsumer($consumer);
    if ($validation->isFailed()) {
      throw new ValidationException($validation);
    }

    // Insert consumer
    $consumerId = $this->repository->insertConsumer($consumer);

    // TODO: Logging here: Consumer created successfully

    return $consumerId;
  }
}
