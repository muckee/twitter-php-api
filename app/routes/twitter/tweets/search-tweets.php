<?php

declare(strict_types=1);

use App\Application\Actions\Twitter\Tweets\SearchTweets\SearchRecentTweetsAction;

/**
 * Search for Tweets published in the last 7 days
 */
$group->get('/tweets/search/recent',
  SearchRecentTweetsAction::class
);

// TODO: Add support for /tweets/search/all in case of future academic use