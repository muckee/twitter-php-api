<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\FilteredStream;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class GetFilteredStreamAction extends TweetsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      // Define valid query parameters
      $options = [
        'query' => [
          'backfill_minutes',
          'expansions',
          'media.fields',
          'place.fields',
          'poll.fields',
          'tweet.fields',
          'user.fields',

        ]
      ];
  
      // Store valid query parameters in $params array
      $params = $this->sortParams($options);

      $payload = $this->tweetsRepository->getFilteredStream($params);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'text/plain');
    }
}