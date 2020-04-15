<?php

declare(strict_types=1);

namespace App\Domain\ConsumerRole\Service;

use App\Domain\ConsumerRole\Data\ConsumerRoleCreateData;
use App\Domain\ConsumerRole\Repository\ConsumerRoleCreatorRepository;
use InvalidArgumentException;

/**
 * Service.
 */
final class ConsumerRoleCreator
{
  /**
   * @var ConsumerRoleCreatorRepository
   */
  private $repository;

  /**
   * The constructor.
   *
   * @param ConsumerRoleCreatorRepository $repository The repository
   */
  public function __construct(ConsumerRoleCreatorRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Create a new consumerRole.
   *
   * @param ConsumerRoleCreateData $consumerRole The consumerRole data
   *
   * @throws InvalidArgumentException
   *
   * @return int The new consumerRole ID
   */
  public function createConsumerRole(ConsumerRoleCreateData $consumerRole)
  {
    // TODO: Check what happens if roleId or consumerId don't exist after setting foreign keys in DB
    $this->repository->insertConsumerRole($consumerRole);
  }
}
