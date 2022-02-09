<?php

declare(strict_types=1);

namespace App\Infrastructure\Remote\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

use App\Domain\Twitter\TwitterRepository;
use App\Application\Handlers\TwitterExceptionHandler;

class RemoteTwitterRepository implements TwitterRepository
{

  protected TwitterOAuth $twitterOAuth;

  /**
   * @param TwitterOAuth $twitterOAuth
   */
  public function __construct(
    TwitterOAuth $twitterOAuth,
    TwitterExceptionHandler $twitterExceptionHandler
  ) {
    $this->twitterOAuth = $twitterOAuth;
    $this->twitterOAuth->setApiVersion('2');
    $this->exceptionHandler = $twitterExceptionHandler;
  }

}