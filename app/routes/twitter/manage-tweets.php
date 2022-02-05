<?php

declare(strict_types=1);

use App\Application\Actions\Twitter\ManageTweets\CreateTweetAction;
use App\Application\Actions\Twitter\ManageTweets\DeleteTweetAction;

// Create a new tweet
$group->post('/tweets',
  CreateTweetAction::class
);

// Delete a tweet with specified ID
$group->delete('/tweets/{id}',
  DeleteTweetAction::class
);