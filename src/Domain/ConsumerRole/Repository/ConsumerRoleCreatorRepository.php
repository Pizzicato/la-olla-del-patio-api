<?php

declare(strict_types=1);

namespace App\Domain\ConsumerRole\Repository;

use App\Domain\ConsumerRole\Data\ConsumerRoleCreateData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class ConsumerRoleCreatorRepository
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
   * Insert consumer role row.
   *
   * @param ConsumerRoleCreateData $consumerRole The consumerRole
   *
   * @return int The new ID
   */
  public function insertConsumerRole(ConsumerRoleCreateData $consumerRole)
  {
    $this->connection->table('consumerRoles')->insertGetId($consumerRole);
  }
}
