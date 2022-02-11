<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Lists\PinnedLists\ManagePinnedLists;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Lists\ListsAction;

class PinListAction extends ListsAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $user_id = $this->args['user_id'];

    $options = [
      'body' => [
        'list_id'
      ]
    ];

    // Store valid query parameters in $params array
    $params = $this->sortParams($options);

    // Derive URI from query
    $uri = 'users' . '/' . $user_id . '/' . 'pinned_lists';

    /**
     * Returns a list of user who purchased a ticket to the requested Space.
     * You must authenticate the request using the Access Token of the creator of the requested Space.
     */
    $response = $this->twitterOAuth->post($uri, $params, true);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // TODO: Create List object

      // Return response to user
      return $this
        ->respondWithData($response)
        ->withHeader('Content-Type', 'application/json');
    }
  }
}