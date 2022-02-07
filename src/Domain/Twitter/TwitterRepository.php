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
     * @param string $id
     * @param string[] $params
     * @return string
     */
    public function getTweet(string $id, array $params): string;

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

    /**
     * @param string $id
     * @param string[] $params
     * @return string
     */
    public function getUserMentionsTimeline(string $id, array $params): string;

    /**
     * @param string[] $params
     * @return string
     */
    public function searchRecentTweets(array $params): string;

    /**
     * @param string[] $params
     * @return string
     */
    public function updateFilteredStreamRules(array $params): string;

    /**
     * @param string[] $params
     * @return string
     */
    public function getFilteredStreamRules(array $params): string;

    /**
     * @param string[] $params
     * @return string
     */
    public function getFilteredStream(array $params): string;

    /**
     * @param string $id
     * @param string[] $params
     * @return string
     */
    public function getRetweetsByUserId(string $id, array $params): string;

    /**
     * @param string $id
     * @param string[] $params
     * @return string
     */
    public function createRetweet(string $id, array $params): string;

    /**
     * @param string $id
     * @param string $sourceTweetId
     * @return string
     */
    public function deleteRetweet(string $id, string $sourceTweetId): string;

    /**
     * @param string $id
     * @param string[] $params
     * @return string
     */
    public function getLikingUsers(string $id, array $params): string;

    /**
     * @param string $id
     * @param string[] $params
     * @return string
     */
    public function getLikedTweets(string $id, array $params): string;

    /**
     * @param string $id
     * @param string[] $params
     * @return string
     */
    public function likeTweet(string $id, array $params): string;

    /**
     * @param string $id
     * @param string $tweetId
     * @return string
     */
    public function deleteLikedTweet(string $id, string $tweetId): string;

    /**
     * @param string $tweetId
     * @param string[] $params
     * @return string
     */
    public function hideReply(string $tweetId, array $params): string;
}