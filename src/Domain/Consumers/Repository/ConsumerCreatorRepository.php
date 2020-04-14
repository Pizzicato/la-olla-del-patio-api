<?php

declare(strict_types=1);

namespace App\Domain\Consumer\Repository;

use App\Domain\Consumer\Data\ConsumerCreateData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class ConsumerCreatorRepository
{
  /**
   * @var PDO The database connection
   */
  private $connection;

  /**
   * Constructor.
   *
   * @param PDO $connection The database connection
   */
  public function __construct(Connection $connection)
  {
    $this->connection = $connection;
  }

  /**
   * Insert consumer row.
   *
   * @param ConsumerCreateData $consumer The consumer
   *
   * @return int The new ID
   */
  public function insertConsumer(ConsumerCreateData $consumer): int
  {
    return $this->connection->table('consumers')->insertGetId($consumer);
  }
}
