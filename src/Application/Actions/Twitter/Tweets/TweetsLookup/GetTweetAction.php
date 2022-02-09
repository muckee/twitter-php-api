<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\TweetsLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\TwitterAction;

class GetTweetAction extends TwitterAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

      $id = ''.$this->args['id'];

      $options = [
        'query' => [
          'expansions',
          'media.fields',
          'place.fields',
          'poll.fields',
          'tweet.fields',
          'user.fields'
        ]
      ];

      $params = $this->sortParams($options);

      $payload = $this->twitterRepository->getTweet($id, $params);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'text/plain');
    }
}