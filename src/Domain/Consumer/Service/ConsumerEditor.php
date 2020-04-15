<?php

declare(strict_types=1);

namespace App\Domain\Consumer\Service;

use App\Domain\Consumer\Data\ConsumerEditData;
use App\Domain\Consumer\Repository\ConsumerEditorRepository;
use App\Domain\Consumer\Validator\ConsumerEditValidator;
use Selective\Validation\Exception\ValidationException;

/**
 * Service.
 */
final class ConsumerEditor
{
  /**
   * @var ConsumerEditorRepository
   */
  private $repository;

  /**
   * @var ConsumerEdiValidator
   */
  protected $validator;

  /**
   * @var LoggerInterface
   */
  private $logger;

  /**
   * The constructor.
   *
   * @param ConsumerEditorRepository $repository The repository
   */
  public function __construct(
    ConsumerEditorRepository $repository,
    ConsumerEditValidator $validator
    )
  {
    $this->repository = $repository;
    $this->validator = $validator;
  }

  /**
   * Edi a new consumer.
   *
   * @param ConsumerEdiData $consumer The consumer data
   *
   * @throws InvalidArgumentException
   *
   * @return int The new consumer ID
   */
  public function editConsumer(int $id, ConsumerEditData $consumer): int
  {
    // Validation
    $validation = $this->validator->validateConsumer($consumer);
    if ($validation->isFailed()) {
      throw new ValidationException($validation);
    }

    // Insert consumer
    $consumerId = $this->repository->updateConsumer($id, $consumer);

    // TODO: Logging here: Consumer edited successfully

    return $consumerId;
  }
}
