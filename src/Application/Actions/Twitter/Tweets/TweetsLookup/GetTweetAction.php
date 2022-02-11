<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\TweetsLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

// Models
use App\Domain\Twitter\Model\Tweet;

class GetTweetAction extends TweetsAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {

    $tweet_id = $this->args['tweet_id'];

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

    $uri = 'tweets' . '/' . $tweet_id;

    // Get tweet by ID
    $response = $this->twitterOAuth->get($uri, $params);

    $status = $this->twitterOAuth->getLastHttpCode();

    if ($this->exceptionHandler->handleErrors($status, $response)) {

      $payload = new Tweet();
      if(property_exists($response, 'data')) {
        $payload->setByJson($response->data);
      }

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'text/plain');
    }
  }
}