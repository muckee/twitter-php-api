<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\Follows\FollowsLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

class GetFollowersByUserIdAction extends UsersAction
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
        'max.results',
        'pagination_token',
        'tweet.fields',
        'user.fields'
      ]
    ];

    $params = $this->sortParams($options);

    // Get tweets based on list of IDs
    $payload = $this->usersRepository->getFollowersByUserId($user_id, $params);

    // Return response to user
    return $this
      ->respondWithData($payload)
      ->withHeader('Content-Type', 'application/json');
  }
}