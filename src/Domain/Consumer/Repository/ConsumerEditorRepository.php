<?php

declare(strict_types=1);

namespace App\Domain\Consumer\Repository;

use App\Domain\Consumer\Data\ConsumerEditData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class ConsumerEditorRepository
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
  public function updateConsumer(int $id, ConsumerEditData $consumer): int
  {
    return $this->connection->table('consumers')->where(['id' => $id])->update($consumer);
  }
}
