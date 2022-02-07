<?php

declare(strict_types=1);

use App\Application\Actions\Twitter\Tweets\TweetCounts\GetRecentTweetCountsAction;

/**
 * Receive a count of Tweets that match a query in the last 7 days
 */
$group->get('/tweets/counts/recent', GetRecentTweetCountsAction::class);

// TODO: Add support for '/tweets/counts/all' in case of future academic use