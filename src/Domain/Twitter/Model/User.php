<?php

declare(strict_types=1);

namespace App\Domain\Twitter\Model;

use DateTime;

use App\Domain\Twitter\Model;

class User extends Model
{
  const AVAILABLE_PROPERTIES = array(
    'id',
    'name',
    'username',
    'created_at',
    'protected',
    'withheld',
    'location',
    'url',
    'description',
    'verified',
    'entities',
    'profile_image_url',
    'public_metrics',
    'pinned_tweet_id',
    'includes',
    'errors'
  );

  // TODO: Add optional properties from responses in API docs

  protected ?string $id;

  protected ?string $name;

  protected ?string $username;

  protected ?DateTime $created_at;

  protected ?bool $protected;

  protected ?object $withheld;

  protected ?string $location;

  protected ?string $url;

  protected ?string $description;

  protected ?bool $verified;

  protected ?object $entities;

  protected ?string $profile_image_url;

  protected ?object $public_metrics;

  protected ?string $pinned_tweet_id;

  protected ?object $includes;

  protected ?object $errors;

  protected function getAvailableProperties(): array {
    return self::AVAILABLE_PROPERTIES;
  }
}