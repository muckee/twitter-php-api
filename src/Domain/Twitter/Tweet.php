<?php

declare(strict_types=1);

namespace App\Domain\Twitter;

use JsonSerializable;

class Tweet implements JsonSerializable
{
  private ?string $id;

  private string $text;

  public function __construct(?string $id, string $text)
  {
    $this->id = $id;
    $this->text = $text;
  }

  public function getId(): ?string
  {
    return $this->id;
  }

  public function getText(): string
  {
    return $this->text;
  }

  // TODO: Either patch Intelephense or declare type
  // #[\ReturnTypeWillChange]
  public function jsonSerialize(): array
  {
    return [
      'id' => $this->id,
      'text' => $this->text,
    ];
  }
}