<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Retweets;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\TwitterAction;

class GetRetweetsByUserIdAction extends TwitterAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      $id = $this->args['id'];

      $options = [
        'query' => [
          'expansions',
          'max_results',
          'media.fields',
          'pagination_token',
          'place.fields',
          'poll.fields',
          'tweet.fields',
          'user.fields'
        ]
      ];
  
      $params = $this->sortParams($options);

      $payload = $this->twitterRepository->getRetweetsByUserId($id, $params);

      // Return response to user
      return $this
        ->respondWithData(json_decode($payload))
        ->withHeader('Content-Type', 'application/json');
    }
}