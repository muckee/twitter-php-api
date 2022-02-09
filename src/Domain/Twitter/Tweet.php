<?php

declare(strict_types=1);

namespace App\Domain\Twitter;

use JsonSerializable;

class Tweet implements JsonSerializable
{
  /**
   * @var string $id
   */
  private ?string $id;

  /**
   * @var string $text
   */
  private string $text;

  public function getId(): ?string
  {
    return $this->id;
  }

  public function getText(): string
  {
    return $this->text;
  }

  public function setByJson($json)
  {
    $this->id = $json->id;
    $this->text = $json->text;
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