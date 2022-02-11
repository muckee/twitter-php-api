<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\ManageTweets;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class DeleteTweetAction extends TweetsAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $tweet_id = $this->args['tweet_id'];

    $uri = 'tweets' . '/' . $tweet_id;

    // Delete tweet by ID
    $response = $this->twitterOAuth->delete($uri);

    if ($this->exceptionHandler->handleErrors($response)) {
  
      if(property_exists($response, 'data')) {
        // Return string derived from bool value
        $payload = $response->data->deleted ? 'true' : 'false';
      } else {
        $payload = 'Valid response not found. Please contact the system administrator.';
      }

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
  
    };
  }
}