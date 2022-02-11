<?php

declare(strict_types=1);

namespace App\Domain\Twitter\Model;

use App\Domain\Twitter\Model;

use App\Domain\Twitter\Model\Tweet;
use App\Domain\Twitter\Model\Metadata;

class TweetList extends Model
{
  const AVAILABLE_PROPERTIES = array(
    'tweets',
    'meta'
  );
  
  /**
   * @var Tweet[] $tweets
   */
  protected ?array $tweets;
  
  /**
   * @var Metadata $meta
   */
  protected ?Metadata $meta;

  public function __construct(
    array $tweets,
    Metadata $meta
  ) {
    parent::__construct();

    $this->tweets = $tweets;
    $this->meta = $meta;
  }
  
  protected function getAvailableProperties(): array {
    return self::AVAILABLE_PROPERTIES;
  }
}