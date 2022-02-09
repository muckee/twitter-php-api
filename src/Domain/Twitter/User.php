<?php

declare(strict_types=1);

namespace App\Domain\Twitter;

use JsonSerializable;

class User implements JsonSerializable
{
  private ?string $id;

  private string $name;

  private string $username;

  public function __construct(?string $id, string $name, string $username)
  {
    $this->id = $id;
    $this->name = $name;
    $this->username = $username;
  }

  public function getId(): ?string
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function getUsername(): string
  {
    return $this->username;
  }

  // TODO: Either patch Intelephense or declare type
  // #[\ReturnTypeWillChange]
  public function jsonSerialize(): array
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'username' => $this->username,
    ];
  }
}