<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Likes\ManageLikes;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class DeleteLikedTweetAction extends TweetsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      $id = ''.$this->args['user_id'];

      $tweetId = ''.$this->args['tweet_id'];

      $payload = $this->tweetsRepository->deleteLikedTweet($id, $tweetId);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
}