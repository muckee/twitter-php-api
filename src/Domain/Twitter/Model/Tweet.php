<?php

declare(strict_types=1);

namespace App\Domain\Twitter\Model;

use DateTime;

use App\Domain\Twitter\Model;

class Tweet extends Model
{
  const AVAILABLE_PROPERTIES = array(
    'id',
    'text',
    'created_at',
    'author_id',
    'conversation_id',
    'in_reply_to_user_id',
    'referenced_tweets',
    'attachments',
    'geo',
    'context_annotations',
    'entities',
    'withheld',
    'public_metrics',
    'non_public_metrics',
    'organic_metrics',
    'promoted_metrics',
    'possibly_sensitive',
    'lang',
    'reply_settings',
    'source',
    'includes',
    'errors'
  );

  /**
   * @var string $id
   */
  protected ?string $id;

  /**
   * @var string $text
   */
  protected ?string $text;

  /**
   * @var DateTime $created_at
   */
  protected ?DateTime $created_at;

  /**
   * @var string $author_id
   */
  protected ?string $author_id;

  /**
   * @var string $conversation_id
   */
  protected ?string $conversation_id;

  /**
   * @var string $in_reply_to_user_id
   */
  protected ?string $in_reply_to_user_id;

  /**
   * @var array $referenced_tweets
   */
  protected ?array $referenced_tweets;

  /**
   * @var array $attachments
   */
  protected ?array $attachments;

  /**
   * @var object $geo
   */
  protected ?object $geo;

  /**
   * @var array $context_annotations
   */
  protected ?array $context_annotations;

  /**
   * @var object $entities
   */
  protected ?object $entities;

  /**
   * @var object $withheld
   */
  protected ?object $withheld;

  /**
   * @var object $public_metrics
   */
  protected ?object $public_metrics;

  /**
   * @var object $non_public_metrics
   */
  protected ?object $non_public_metrics;

  /**
   * @var object $organic_metrics
   */
  protected ?object $organic_metrics;

  /**
   * @var object $promoted_metrics
   */
  protected ?object $promoted_metrics;

  /**
   * @var bool $possibly_sensitive
   */
  protected ?bool $possibly_sensitive;

  /**
   * @var string $lang
   */
  protected ?string $lang;

  /**
   * @var string $reply_settings
   */
  protected ?string $reply_settings;

  /**
   * @var string $source
   */
  protected ?string $source;

  /**
   * @var object $includes
   */
  protected ?object $includes;

  /**
   * @var object $errors
   */
  protected ?object $errors;

  protected function getAvailableProperties(): array {
    return self::AVAILABLE_PROPERTIES;
  }
}