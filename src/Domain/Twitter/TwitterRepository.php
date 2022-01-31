<?php

declare(strict_types=1);

namespace App\Domain\Twitter;

interface TwitterRepository
{
    /**
     * @param string $text
     * @return string
     */
    public function createTweet(string $text): string;
}