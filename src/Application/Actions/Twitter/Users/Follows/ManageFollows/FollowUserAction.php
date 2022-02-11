<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\Follows\ManageFollows;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

class FollowUserAction extends UsersAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {

    $user_id = $this->args['user_id'];

    // Define list of known query options for this action
    $options = [
      'body' => [
        'target_user_id'
      ]
    ];

    $params = $this->sortParams($options);

    $uri = 'users' . '/' . $user_id . '/' . 'following';


    // Get tweet
    $response = $this->twitterOAuth->post($uri, $params, true);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {
  
      if(property_exists($response, 'data')) {
        $payload = json_encode($response->data);
      } else {
        $payload = 'No valid response was found. Please contact the system administrator.';
      }

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
  }
}