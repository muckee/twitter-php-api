<?php

declare(strict_types=1);

namespace App\Domain\Twitter\FilteredStream;

use JsonSerializable;

class FilteredStreamRule implements JsonSerializable
{
  private ?string $id;

  private string $value;

  private string $tag;

  public function __construct(?string $id, string $value, string $tag)
  {
    $this->id = $id;
    $this->value = $value;
    $this->tag = $tag;
  }

  public function getId(): ?string
  {
    return $this->id;
  }

  public function getValue(): string
  {
    return $this->value;
  }

  public function getTag(): string
  {
    return $this->tag;
  }

  // TODO: Either patch Intelephense or declare type
  // #[\ReturnTypeWillChange]
  public function jsonSerialize(): array
  {
    return [
      'id' => $this->id,
      'value' => $this->value,
      'tag' => $this->tag,
    ];
  }
}