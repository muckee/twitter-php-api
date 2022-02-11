<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\Blocks\BlocksLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

use App\Domain\Twitter\Model\User;
use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\UserList;

class GetBlockedUsersAction extends UsersAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $user_id = $this->args['user_id'];

    // Define list of known query options for this action
    $options = [
      'query' => [
        'expansions',
        'max_results',
        'pagination_token',
        'tweet.fields',
        'user.fields'
      ]
    ];

    $params = $this->sortParams($options);

    $uri = 'users' . '/' . $user_id . '/' . 'blocking';

    // Get blocked users
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