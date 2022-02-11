<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets;

use Abraham\TwitterOAuth\TwitterOAuth;
use Psr\Log\LoggerInterface;

use App\Application\Actions\Twitter\TwitterAction;

use App\Application\Handlers\TwitterExceptionHandler;

abstract class TweetsAction extends TwitterAction
{

  public function __construct(
    LoggerInterface $logger,
    TwitterOAuth $twitterOAuth,
    TwitterExceptionHandler $twitterExceptionHandler
  ) {
    parent::__construct(
      $logger,
      $twitterOAuth,
      $twitterExceptionHandler
    );
  }
}