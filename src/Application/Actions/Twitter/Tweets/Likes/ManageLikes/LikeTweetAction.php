<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Likes\ManageLikes;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class LikeTweetAction extends TweetsAction
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

    $uri = 'users' . '/' . $user_id . '/' . 'likes';

    // Update filtered stream rules
    $response = $this->twitterOAuth->post( $uri, $params, true );

    $status = $this->twitterOAuth->getLastHttpCode();

    if ( $this->exceptionHandler->handleErrors( $status, $response ) ) {

      if(property_exists($response, 'data')) {
        $payload = $response->data->liked;
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