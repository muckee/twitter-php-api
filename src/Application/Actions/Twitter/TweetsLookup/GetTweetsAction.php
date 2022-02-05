<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\TweetsLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\TwitterAction;

class GetTweetsAction extends TwitterAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    // Define list of known query options for this action
    $options = [
      'ids',
      'expansions',
      'media.fields',
      'place.fields',
      'poll.fields',
      'tweet.fields',
      'user.fields'
    ];

    $params = $this->sortQueryParams($options);

    // Get tweets based on list of IDs
    $payload = $this->twitterRepository->getTweets($params);

    // Return response to user
    return $this
      ->respondWithData($payload)
      ->withHeader('Content-Type', 'application/json');
  }
}