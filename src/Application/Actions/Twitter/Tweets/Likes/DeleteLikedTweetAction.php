<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Likes;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\TwitterAction;

class DeleteLikedTweetAction extends TwitterAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

      $id = ''.$this->args['id'];

      $tweetId = ''.$this->args['tweet_id'];

      $payload = $this->twitterRepository->deleteLikedTweet($id, $tweetId);

      // Return response to user
      return $this
        ->respondWithData(json_decode($payload))
        ->withHeader('Content-Type', 'application/json');
    }
}