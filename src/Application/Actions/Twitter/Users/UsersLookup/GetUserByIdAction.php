<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\UsersLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

use App\Domain\Twitter\Model\User;

class GetUserByIdAction extends UsersAction
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
        'tweet.fields',
        'user.fields'
      ]
    ];

    $params = $this->sortParams($options);

    $uri = 'users' . '/' . $user_id;
    // Get tweet
    $response = $this->twitterOAuth->get($uri, $params);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {
  
      $payload = new User();
  
      if(property_exists($response, 'data')) {
        $payload->setByJson($response->data);
      }

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
  }
}