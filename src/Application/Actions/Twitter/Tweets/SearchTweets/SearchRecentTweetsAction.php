<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\SearchTweets;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\TwitterAction;

class SearchRecentTweetsAction extends TwitterAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      $options = [
        'query' => [
          'query',
          'end_time',
          'expansions',
          'max_results',
          'media.fields',
          'next_token',
          'place.fields',
          'poll.fields',
          'since_id',
          'start_time',
          'tweet.fields',
          'until_id',
          'user.fields'
        ]
      ];
  
      $params = $this->sortParams($options);

      $payload = $this->twitterRepository->searchRecentTweets($params);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
}