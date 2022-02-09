<?php

declare(strict_types=1);

namespace App\Domain\Twitter\Tweets;

use JsonSerializable;

use App\Domain\Twitter\Tweets\FilteredStreamRule;
use App\Domain\Twitter\Metadata;

class FilteredStreamRuleSet implements JsonSerializable
{
  private array $rules;

  private Metadata $summary;

  public function __construct(array $rules, Metadata $summary)
  {
    $this->rules = $rules;
    $this->summary = $summary;
  }

  public function getRules(): array
  {
    return $this->rules;
  }

  public function getSummary(): Metadata
  {
    return $this->summary;
  }

  public function addRule(FilteredStreamRule $rule)
  {
    $this->rules[] = $rule;
  }

  public function setSummaryChanged(int $changed)
  {
    $this->summary->setChanged($changed);
  }

  public function setSummaryNotChanged(int $not_changed)
  {
    $this->summary->setNotChanged($not_changed);
  }

  public function setSummaryValid(int $valid)
  {
    $this->summary->setValid($valid);
  }

  public function setSummaryInvalid(int $invalid)
  {
    $this->summary->setInvalid($invalid);
  }

  // TODO: Either patch Intelephense or declare type
  // #[\ReturnTypeWillChange]
  public function jsonSerialize(): array
  {
    return [
      'rules' => $this->rules,
      'summary' => $this->summary,
    ];
  }
}