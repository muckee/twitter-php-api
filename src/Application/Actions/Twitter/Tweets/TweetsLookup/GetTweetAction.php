<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\TweetsLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class GetTweetAction extends TweetsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

      $id = ''.$this->args['tweet_id'];

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

      $payload = $this->tweetsRepository->getTweet($id, $params);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'text/plain');
    }
}