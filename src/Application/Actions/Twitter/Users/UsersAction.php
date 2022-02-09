<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users;

use Psr\Log\LoggerInterface;

use App\Application\Actions\Twitter\TwitterAction;

use App\Domain\Twitter\TwitterRepository\UsersRepository;

abstract class UsersAction extends TwitterAction
{

  protected UsersRepository $usersRepository;

  public function __construct(
    LoggerInterface $logger,
    UsersRepository $usersRepository
  ) {
    parent::__construct($logger);

    $this->usersRepository = $usersRepository;
  }

}