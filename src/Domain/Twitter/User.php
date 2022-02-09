<?php

declare(strict_types=1);

namespace App\Domain\Twitter;

use JsonSerializable;

class User implements JsonSerializable
{
  // TODO: Add optional properties from responses in API docs

  private ?string $id;

  private ?string $name;

  private ?string $username;

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

  public function setByJson($json)
  {
    $this->id = $json->id;
    $this->name = $json->name;
    $this->username = $json->username;
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