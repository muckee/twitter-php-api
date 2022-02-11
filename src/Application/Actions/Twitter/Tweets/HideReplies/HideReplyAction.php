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

    // TODO: Fix 'unauthorised' issue
    $payload = 'This endpoint is not currently supported. Please contact the system administrator.';

    // Return response to user
    return $this
      ->respondWithData($payload)
      ->withHeader('Content-Type', 'application/json');

    $tweet_id = ''.$this->args['tweet_id'];

    $options = [
      'body' => [
        'hidden'
      ]
    ];

    $params = $this->sortParams($options);
  
    $uri = 'tweets' . '/' . $tweet_id . '/' . 'hidden';

    $result = $this->twitterOAuth->put( $uri, $params, true );

    $status = $this->twitterOAuth->getLastHttpCode();

    if ( $this->exceptionHandler->handleErrors( $status, $result ) ) {

      $payload = json_encode( $result );

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    };
  }
}