<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\UsersLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

use App\Domain\Twitter\Model\User;

class GetAuthorizedUserAction extends UsersAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    // Define list of known query options for this action
    $options = [
      'query' => [
        'expansions',
        'tweet.fields',
        'user.fields'
      ]
    ];

    $params = $this->sortParams($options);

    $uri = 'users' . '/' . 'me';

    // Get tweet
    $response = $this->twitterOAuth->get($uri, $params);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {
  
      $payload = new User();
      $payload->setByJson($response);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
  }
}