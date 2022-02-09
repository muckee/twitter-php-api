<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets;

use Psr\Log\LoggerInterface;

use App\Application\Actions\Twitter\TwitterAction;

use App\Domain\Twitter\TwitterRepository\TweetsRepository;

abstract class TweetsAction extends TwitterAction
{

  protected TweetsRepository $tweetsRepository;

  public function __construct(
    LoggerInterface $logger,
    TweetsRepository $tweetsRepository
  ) {
    parent::__construct($logger);

    $this->tweetsRepository = $tweetsRepository;
  }

}