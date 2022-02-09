<?php

declare(strict_types=1);

namespace App\Domain\Twitter\TwitterRepository;

// Models
use App\Domain\Twitter\Tweet;
use App\Domain\Twitter\TwitterList;
use App\Domain\Twitter\FilteredStream\FilteredStreamRuleSet;

interface TweetsRepository
{
    /**
     * Returns multiple tweets from a comma-separated list of tweet IDs
     * @param string[] $params
     * @return Tweet[]
     */
    public function getTweets(array $params): array;
    /**
     * Returns single tweets from a tweet ID
     * @param string $id
     * @param string[] $params
     * @return Tweet
     */
    public function getTweet(string $id, array $params): Tweet;

    /**
     * @param string[] $params
     * @return Tweet
     */
    public function createTweet(array $params): Tweet;

    /**
     * @param string $id
     * @return string
     */
    public function deleteTweet(string $id): string;

    /**
     * @param string $id
     * @param string[] $params
     * @return Tweets[]
     */
    public function getUserTimeline(string $id, array $params): array;

    /**
     * @param string $id
     * @param string[] $params
     * @return Tweets[]
     */
    public function getUserMentionsTimeline(string $id, array $params): array;

    /**
     * @param string[] $params
     * @return Tweets[]
     */
    public function searchRecentTweets(array $params): array;

    /**
     * @param string[] $params
     * @return FilteredStreamRuleSet
     */
    public function updateFilteredStreamRules(array $params): FilteredStreamRuleSet;

    /**
     * @param string[] $params
     * @return FilteredStreamRuleSet
     */
    public function getFilteredStreamRules(array $params): FilteredStreamRuleSet;

    /**
     * @param string[] $params
     * @return string
     */
    public function getFilteredStream(array $params): string;

    /**
     * @param string $id
     * @param string[] $params
     * @return TwitterList
     */
    public function getRetweetsByTweetId(string $id, array $params): TwitterList;

    /**
     * @param string $id
     * @param string[] $params
     * @return bool
     */
    public function createRetweet(string $id, array $params): bool;

    /**
     * @param string $id
     * @param string $sourceTweetId
     * @return bool
     */
    public function deleteRetweet(string $id, string $sourceTweetId): bool;

    /**
     * @param string $id
     * @param string[] $params
     * @return TwitterList
     */
    public function getLikingUsers(string $id, array $params): TwitterList;

    /**
     * @param string $id
     * @param string[] $params
     * @return TwitterList
     */
    public function getLikedTweets(string $id, array $params): TwitterList;

    /**
     * @param string $id
     * @param string[] $params
     * @return bool
     */
    public function likeTweet(string $id, array $params): bool;

    /**
     * @param string $id
     * @param string $tweetId
     * @return bool
     */
    public function deleteLikedTweet(string $id, string $tweetId): bool;

    /**
     * @param string $tweetId
     * @param string[] $params
     * @return string
     */
    public function hideReply(string $tweetId, array $params): string;
}