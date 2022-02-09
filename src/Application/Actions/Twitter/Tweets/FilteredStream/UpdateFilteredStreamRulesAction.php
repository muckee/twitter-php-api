<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\FilteredStream;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\TwitterAction;

class UpdateFilteredStreamRulesAction extends TwitterAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      // Define valid query parameters
      $options = [
        'query' => [
          'dry_run'
        ],
        'body' => [
          'add',
          'add.value',
          'delete',
          'delete.ids',
          'add.tag'
        ]
      ];
  
      // Store valid query parameters in $params array
      $params = $this->sortParams($options);

      $payload = $this->twitterRepository->updateFilteredStreamRules($params);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
}