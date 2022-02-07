<?php

declare(strict_types=1);

use App\Application\Actions\Twitter\Tweets\TweetsLookup\GetTweetAction;
use App\Application\Actions\Twitter\Tweets\TweetsLookup\GetTweetsAction;

/**
 * Retrieve multiple tweets with a list of IDs
 */
$group->get('/tweets', GetTweetsAction::class);

/**
 * Retrieve a single tweet with an ID
 */
$group->get('/tweets/{id}', GetTweetAction::class);