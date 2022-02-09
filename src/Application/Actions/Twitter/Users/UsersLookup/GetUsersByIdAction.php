<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\UsersLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

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

    // Get tweets based on list of IDs
    $payload = $this->usersRepository->getUsersById($params);

    // Return response to user
    return $this
      ->respondWithData($payload)
      ->withHeader('Content-Type', 'application/json');
  }
}