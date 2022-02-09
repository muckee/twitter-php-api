<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Likes\LikesLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class GetLikingUsersAction extends TweetsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

      $tweet_id = ''.$this->args['tweet_id'];

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

      $payload = $this->tweetsRepository->getLikingUsers($tweet_id, $params);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
}