<?php

declare(strict_types=1);

namespace App\Domain\Twitter;

interface TwitterRepository
{
    /**
     * Returns multiple tweets from a comma-separated list of tweet IDs
     * @param string[] $params
     * @return string[]
     */
    public function getTweets(array $params): array;
    /**
     * Returns single tweets from a tweet ID
     * @param int $id
     * @param string[] $params
     * @return string
     */
    public function getTweet(int $id, array $params): string;

    /**
     * @param string[] $params
     * @return string
     */
    public function createTweet(array $params): string;

    /**
     * @param string $id
     * @return string
     */
    public function deleteTweet(string $id): string;

    /**
     * @param string $id
     * @param string[] $params
     * @return string
     */
    public function getUserTimeline(string $id, array $params): string;
}