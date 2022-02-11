<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\Blocks\ManageBlocks;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

class UnblockUserAction extends UsersAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $user_id = $this->args['user_id'];
    $target_user_id = $this->args['target_user_id'];

    $uri = 'users' . '/' . $user_id . '/' . 'blocking' . '/' . $target_user_id;

    // Get tweet
    $response = $this->twitterOAuth->delete($uri);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {
  
      if(property_exists($response, 'data')) {
        // TODO: Include response data as properties in Metadata class and return Metadata object to user
        $payload = json_encode($response->data);
      } else {
        $payload = 'No valid response found. Please contact the system administrator.';
      }

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
  }
}