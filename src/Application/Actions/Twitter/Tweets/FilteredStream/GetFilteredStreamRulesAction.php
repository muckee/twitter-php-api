<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\FilteredStream;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class GetFilteredStreamRulesAction extends TweetsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      // Define valid query parameters
      $options = [
        'query' => [
          'ids'
        ]
      ];
  
      // Store valid query parameters in $params array
      $params = $this->sortParams($options);

      $payload = $this->tweetsRepository->getFilteredStreamRules($params);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
}