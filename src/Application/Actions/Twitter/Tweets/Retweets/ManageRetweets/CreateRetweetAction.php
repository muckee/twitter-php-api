<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Retweets\ManageRetweets;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class CreateRetweetAction extends TweetsAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $user_id = $this->args['user_id'];

    $options = [
      'body' => [
        'tweet_id'
      ]
    ];

    $params = $this->sortParams($options);

    $uri = 'users' . '/' . $user_id . '/' . 'retweets';

    // Update filtered stream rules
    $response = $this->twitterOAuth->post( $uri, $params, true );

    if ( $this->exceptionHandler->handleErrors( $this->twitterOAuth->getLastHttpCode(), $response ) ) {

      if(property_exists($response, 'data')) {
        $payload = $response->data->retweeted;
      } else {
        $payload = 'No valid response was found. Please contact the system administrator.';
      }

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    };
  }
}