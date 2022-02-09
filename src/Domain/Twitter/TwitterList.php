<?php

declare(strict_types=1);

namespace App\Domain\Twitter;

use JsonSerializable;

use App\Domain\Twitter\Metadata;

class TwitterList implements JsonSerializable
{
  private array $list;

  private Metadata $meta;

  public function __construct(array $list, Metadata $meta)
  {
    $this->list = $list;
    $this->meta = $meta;
  }

  public function getList(): array
  {
    return $this->list;
  }

  public function getMeta(): Metadata
  {
    return $this->meta;
  }

  // TODO: Either patch Intelephense or declare type
  // #[\ReturnTypeWillChange]
  public function jsonSerialize(): array
  {
    return [
      'data' => $this->list,
      'meta' => $this->meta,
    ];
  }
}