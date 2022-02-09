<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Retweets;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class CreateRetweetAction extends TweetsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      $id = ''.$this->args['user_id'];

      $options = [
        'body' => [
          'tweet_id'
        ]
      ];
  
      $params = $this->sortParams($options);

      $payload = $this->tweetsRepository->createRetweet($id, $params);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
}