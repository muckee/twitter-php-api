<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Retweets;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class DeleteRetweetAction extends TweetsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      $id = ''.$this->args['user_id'];
      $sourceTweetId = ''.$this->args['source_tweet_id'];

      $payload = $this->tweetsRepository->deleteRetweet($id, $sourceTweetId);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
}