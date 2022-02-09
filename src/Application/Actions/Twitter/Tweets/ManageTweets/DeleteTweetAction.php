<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\ManageTweets;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class DeleteTweetAction extends TweetsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      $tweet_id = ''.$this->args['tweet_id'];

      $payload = $this->tweetsRepository->deleteTweet($tweet_id);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
}