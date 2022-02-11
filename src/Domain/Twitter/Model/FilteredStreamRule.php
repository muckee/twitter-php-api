<?php

declare(strict_types=1);

namespace App\Domain\Twitter\Model;

use App\Domain\Twitter\Model;

class FilteredStreamRule extends Model
{
  const AVAILABLE_PROPERTIES = array(
    'id',
    'value',
    'tag'
  );

  protected ?string $id;

  protected string $value;

  protected string $tag;

  protected function getAvailableProperties(): array {
    return self::AVAILABLE_PROPERTIES;
  }
}