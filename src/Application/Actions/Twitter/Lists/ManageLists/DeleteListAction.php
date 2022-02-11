<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Lists\ManageLists;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Lists\ListsAction;

class DeleteListAction extends ListsAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $list_id = $this->args['list_id'];

    // Derive URI from query
    $uri = 'lists' . '/' . $list_id;

    /**
     * Returns a list of user who purchased a ticket to the requested Space.
     * You must authenticate the request using the Access Token of the creator of the requested Space.
     */
    $response = $this->twitterOAuth->delete($uri);

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