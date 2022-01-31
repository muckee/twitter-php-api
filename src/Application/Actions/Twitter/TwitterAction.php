<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter;

use App\Application\Actions\Action;
use App\Domain\Twitter\TwitterRepository;
use Psr\Log\LoggerInterface;

abstract class TwitterAction extends Action
{
    protected TwitterRepository $twitterRepository;

    public function __construct(
        LoggerInterface $logger,
        TwitterRepository $twitterRepository
    ) {
        parent::__construct($logger);
        $this->twitterRepository = $twitterRepository;
    }
}