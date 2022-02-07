<?php

declare(strict_types=1);

use App\Application\Actions\Twitter\Tweets\ManageTweets\CreateTweetAction;
use App\Application\Actions\Twitter\Tweets\ManageTweets\DeleteTweetAction;

/**
 * Post a tweet
 */
$group->post('/tweets', CreateTweetAction::class);

/**
 * Delete a tweet with specified ID
 */
$group->delete('/tweets/{id}', DeleteTweetAction::class);