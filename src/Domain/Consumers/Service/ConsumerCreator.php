<?php

declare(strict_types=1);

namespace App\Domain\Consumer\Service;

use App\Domain\Consumer\Data\ConsumerCreateData;
use App\Domain\Consumer\Repository\ConsumerCreatorRepository;
use InvalidArgumentException;

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
   * The constructor.
   *
   * @param ConsumerCreatorRepository $repository The repository
   */
  public function __construct(ConsumerCreatorRepository $repository)
  {
    $this->repository = $repository;
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
    if (empty($consumer->name)) {
      throw new InvalidArgumentException('Name required');
    }

    // TODO: Mail validation
    if (empty($consumer->email)) {
      throw new InvalidArgumentException('Email required');
    }

    if (empty($consumer->password)) {
      throw new InvalidArgumentException('Password required');
    }

    if (empty($consumer->roleIds)) {
      throw new InvalidArgumentException('Group(s) required');
    }

    // Insert consumer
    $consumerId = $this->repository->insertConsumer($consumer);

    // TODO: Logging here: Consumer created successfully

    return $consumerId;
  }
}
