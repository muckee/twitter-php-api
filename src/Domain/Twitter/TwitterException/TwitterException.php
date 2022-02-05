<?php

declare(strict_types=1);

namespace App\Domain\Twitter\TwitterException;

use App\Domain\DomainException\DomainException;

class TwitterException extends DomainException
{

    /**
     * @param string $errMsg
     */
    public function __construct(
      string $message
    ) {
      $this->message = $message;
    }
}