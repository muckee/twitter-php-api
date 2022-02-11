<?php

declare(strict_types=1);

namespace App\Domain\Twitter\Model;

use App\Domain\Twitter\Model;

use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\FilteredStreamRule;

class FilteredStreamRuleList extends Model
{
  const AVAILABLE_PROPERTIES = array(
    'rules',
    'meta'
  );
  
  /**
   * @var FilteredStreamRule[] $users
   */
  protected ?array $rules;
  
  /**
   * @var ?Metadata $meta
   */
  protected Metadata $meta;

  public function __construct(
    array $rules,
    Metadata $meta
  ) {
    parent::__construct();

    $this->rules = $rules;
    $this->meta = $meta;
  }
  
  protected function getAvailableProperties(): array {
    return self::AVAILABLE_PROPERTIES;
  }
}