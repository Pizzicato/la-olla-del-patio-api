<?php

declare(strict_types=1);

namespace App\Domain\ConsumerRole\Data;

use Selective\ArrayReader\ArrayReader;

final class ConsumerRoleCreateData
{
  /** @var string */
  public $id;

  /** @var string */
  public $consumerId;

  /** @var string */
  public $roleId;

  public function __construct(array $array = [])
  {
    $data = new ArrayReader($array);

    $this->id = $data->findInt('id');
    $this->name = $data->findString('consumerId');
    $this->email = $data->findString('roleId');
  }

}
