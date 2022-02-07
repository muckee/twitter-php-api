<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Retweets;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\TwitterAction;

class CreateRetweetAction extends TwitterAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      $id = ''.$this->args['id'];

      $options = [
        'body' => [
          'tweet_id'
        ]
      ];
  
      $params = $this->sortParams($options);

      $payload = $this->twitterRepository->createRetweet($id, $params);

      // Return response to user
      return $this
        ->respondWithData(json_decode($payload))
        ->withHeader('Content-Type', 'application/json');
    }
}