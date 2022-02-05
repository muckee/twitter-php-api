<?php

declare(strict_types=1);

use App\Application\Actions\Twitter\TweetsLookup\GetTweetAction;
use App\Application\Actions\Twitter\TweetsLookup\GetTweetsAction;

// Get a list of tweets based on a CSV string of tweet IDs
$group->get('/tweets',
  GetTweetsAction::class
);

// Get a single tweet based on a tweet ID
$group->get('/tweets/{id}',
  GetTweetAction::class
);