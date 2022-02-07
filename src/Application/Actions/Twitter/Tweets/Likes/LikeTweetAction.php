<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Likes;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\TwitterAction;

class LikeTweetAction extends TwitterAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

      $options = [
        'body' => [
          'tweet_id'
        ]
      ];
  
      $params = $this->sortParams($options);

      $id = ''.$this->args['id'];

      $payload = $this->twitterRepository->likeTweet($id, $params);

      // Return response to user
      return $this
        ->respondWithData(json_decode($payload))
        ->withHeader('Content-Type', 'application/json');
    }
}