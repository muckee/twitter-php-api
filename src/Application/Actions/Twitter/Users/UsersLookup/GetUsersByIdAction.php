<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\UsersLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

use App\Domain\Twitter\Model\User;
use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\UserList;

class GetUsersByIdAction extends UsersAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    // Define list of known query options for this action
    $options = [
      'query' => [
        'ids',
        'expansions',
        'tweet.fields',
        'user.fields'
      ]
    ];

    $params = $this->sortParams($options);

    $uri = 'users';

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
      $payload = new UserList($results, $meta);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
  }
}