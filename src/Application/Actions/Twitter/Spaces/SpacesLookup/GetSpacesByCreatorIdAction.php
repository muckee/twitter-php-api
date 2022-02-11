<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Spaces\SpacesLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Spaces\SpacesAction;

class GetSpacesByCreatorIdAction extends SpacesAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {

    // Define valid query parameters
    $options = [
      'query' => [
        'user_ids',
        'expansions',
        'space.fields',
        'topic.fields',
        'user.fields'
      ]
    ];

    // Store valid query parameters in $params array
    $params = $this->sortParams($options);

    // Derive URI from query
    $uri = 'spaces' . '/' . 'by' . '/' . 'creator_ids';

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