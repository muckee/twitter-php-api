<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Spaces\SpacesLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Spaces\SpacesAction;

class GetSpaceTweetsByIdAction extends SpacesAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $space_id = $this->args['space_id'];

    // Define valid query parameters
    $options = [
      'query' => [
        'ids',
        'expansions',
        'media.fields',
        'place.fields',
        'poll.fields',
        'tweet.fields',
        'user.fields'
      ]
    ];

    // Store valid query parameters in $params array
    $params = $this->sortParams($options);

    // Derive URI from query
    $uri = 'spaces' . '/' . $space_id . '/' . 'tweets';

    $access_token = $this->twitterOAuth->oauth2(
      'oauth2/token',
      array('grant_type' => 'client_credentials')
    );
  
    $this->twitterOAuth->setBearer( $access_token->access_token );

    /**
     * Returns a list of user who purchased a ticket to the requested Space.
     * You must authenticate the request using the Access Token of the creator of the requested Space.
     */
    $response = $this->twitterOAuth->get($uri, $params);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // Return response to user
      return $this
        ->respondWithData($response)
        ->withHeader('Content-Type', 'application/json');
    }
  }
}