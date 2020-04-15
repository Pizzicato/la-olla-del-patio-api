<?php

declare(strict_types=1);

namespace App\Domain\Consumer\Data;

use Selective\ArrayReader\ArrayReader;

final class ConsumerCreateData
{
  /** @var string */
  public $name;
  
  /** @var string */
  public $email;

  /** @var string */
  public $password;

  /** @var string */
  public $passwordConfirmation;

  /** @var string|null */
  public $phone;

  public function __construct(array $array = [])
  {
    $data = new ArrayReader($array);

    $this->id = $data->findInt('id');
    $this->name = $data->findString('name');
    $this->email = $data->findString('email');
    $this->password = $data->findString('password');
    $this->password = $data->findString('passwordConfirmation');
    $this->phone = $data->findString('phone');
  }

}
