<?php

declare(strict_types=1);

namespace App\Domain\Consumer\Data;

use Selective\ArrayReader\ArrayReader;

final class ConsumerEditData
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

  /** @var boolean|null */
  public $active;

  /** @var string|null */
  public $paymentDate;

  /** @var string|null */
  public $comments;

  /** @var string[] */
  public $roleIds;

  public function __construct(array $array = [])
  {
    $data = new ArrayReader($array);

    $this->name = $data->findString('name');
    $this->email = $data->findString('email');
    $this->password = $data->findString('password');
    $this->password = $data->findString('passwordConfirmation');
    $this->phone = $data->findString('phone');
    $this->active = $data->getBool('enabled', false);
    $this->paymentDate = $data->findString('paymentDate');
    $this->comments = $data->findString('comments');
    $this->roleIds = $data->findArray('roleIds');
  }

}
