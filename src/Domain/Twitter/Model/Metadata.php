<?php

declare(strict_types=1);

namespace App\Domain\Twitter\Model;

use App\Domain\Twitter\Model;

class Metadata extends Model
{
  const AVAILABLE_PROPERTIES = array(
    'sent',
    'previous_token',
    'next_token',
    'result_count',
    'changed',
    'not_changed',
    'valid',
    'invalid'
  );

  protected ?string $sent;

  protected ?string $previous_token;

  protected ?string $next_token;

  protected ?int $result_count;

  protected ?int $changed;

  protected ?int $not_changed;

  protected ?int $valid;

  protected ?int $invalid;

  protected function getAvailableProperties(): array {
    return self::AVAILABLE_PROPERTIES;
  }
}