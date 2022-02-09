<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\HideReplies;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class HideReplyAction extends TweetsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

      $options = [
        'body' => [
          'hidden'
        ]
      ];
  
      $params = $this->sortParams($options);

      $tweetId = ''.$this->args['tweet_id'];

      $payload = $this->tweetsRepository->hideReply($tweetId, $params);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
}