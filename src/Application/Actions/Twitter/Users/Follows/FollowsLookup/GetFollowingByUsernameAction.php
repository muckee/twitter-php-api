<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\Follows\FollowsLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

use App\Domain\Twitter\Model\User;
use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\UserList;

class GetFollowingByUsernameAction extends UsersAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {

    // TODO: Periodically check for updates to twitter docs regarding this endpoint
    $payload = 'This endpoint is not properly documented by Twitter. Please contact the system administrator';

    // Return response to user
    return $this
      ->respondWithData($payload)
      ->withHeader('Content-Type', 'application/text');

    $username = $this->args['username'];

    // Define list of known query options for this action
    $options = [];

    $params = $this->sortParams($options);

    $uri = 'users' . '/' . 'by' . '/' . 'username' . '/' . $username . '/' . 'following';

    // Get tweet
    $response = $this->twitterOAuth->get($uri, $params);


    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {
  
      // Initialise empty array to store results
      $results = [];
  
      if(property_exists($response, 'data')) {
        // Iterate over resulting tweets
        foreach($response->data as $result) {
    
          $user = new User();
          $user->setByJson($result);
    
          $results[] = $user;
        }
      }
  
      $meta = new Metadata();
      $meta->setByJson($response->meta);
  
      $payload = new UserList($results, $meta);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
  }
}