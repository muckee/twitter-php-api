<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter;

use App\Application\Actions\Action;

use Psr\Log\LoggerInterface;

use App\Domain\Twitter\TwitterRepository;
use App\Application\Handlers\TwitterQueryHandler;

abstract class TwitterAction extends Action
{

  protected TwitterRepository $twitterRepository;

  public function __construct(
    LoggerInterface $logger,
    TwitterRepository $twitterRepository,
    TwitterQueryHandler $twitterQueryHandler
  ) {

    parent::__construct($logger);

    $this->twitterRepository = $twitterRepository;
    $this->twitterQueryHandler = $twitterQueryHandler;
  }

  /**
   * Extract valid options from query params
   * @param string[] $keys
   * @return string[]
   */
  protected function sortQueryParams(array $keys): array {

    $params = $this->twitterQueryHandler->sortQueries(
      $keys,
      $this->request->getQueryParams()
    );

    return $params;
  }
}