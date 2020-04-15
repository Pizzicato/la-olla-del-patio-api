<?php

declare(strict_types=1);

namespace App\Domain\Consumer\Validator;

use App\Domain\Consumer\Data\ConsumerCreateData;
use Selective\Validation\ValidationResult;

/**
 * Validator.
 */
final class ConsumerCreateValidator
{
  /**
   * Validate.
   *
   * @param ConsumerCreatorData $consumer The consumer
   *
   * @return ValidationResult The validation result
   */
  public function validateConsumer(ConsumerCreateData $consumer): ValidationResult
  {
    $validation = new ValidationResult();

    if (empty($consumer->name)) {
      $validation->addError('name', 'Input required');
    }

    if (empty($consumer->email)) {
      $validation->addError('email', 'Input required');
    } elseif (filter_var($consumer->email, FILTER_VALIDATE_EMAIL) === false) {
      $validation->addError('email', 'Invalid email address');
    }

    if (empty($consumer->password)) {
      $validation->addError('password', 'Input required');
    } elseif (strlen($consumer->password) < 8) {
      $validation->addError('password', 'Min of 8 characters');
    }

    if($consumer->password !== $consumer->passwordConfirmation) {
      $validation->addError('password', 'Different than password confirmation');
    }

    if (empty($consumer->phone)) {
      $validation->addError('phone', 'Input required');
    }

    return $validation;
  }
}
