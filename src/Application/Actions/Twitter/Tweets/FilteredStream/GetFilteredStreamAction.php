<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\FilteredStream;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class GetFilteredStreamAction extends TweetsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

      $payload = 'Stream is not supported by this API. It must be called directly from your application.';

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'text/plain');

        // Define valid query parameters
      $options = [
        'query' => [
          'backfill_minutes',
          'expansions',
          'media.fields',
          'place.fields',
          'poll.fields',
          'tweet.fields',
          'user.fields',

        ]
      ];
  
      // Store valid query parameters in $params array
      $params = $this->sortParams($options);

      $uri = 'tweets' . '/' . 'search' . '/' . 'stream';

      $access_token = $this->twitterOAuth->oauth2(
        'oauth2/token',
        array( 'grant_type' => 'client_credentials' )
      );
    
      $this->twitterOAuth->setBearer( $access_token->access_token );
    
      // Update filtered stream rules
      $response = $this->twitterOAuth->get( $uri, $params, true );

      $status = $this->twitterOAuth->getLastHttpCode();

      if ( $this->exceptionHandler->handleErrors( $status, $response ) ) {

        $payload = json_encode($response);

        // Return response to user
        return $this
          ->respondWithData($payload)
          ->withHeader('Content-Type', 'text/plain');
      };
    }
}