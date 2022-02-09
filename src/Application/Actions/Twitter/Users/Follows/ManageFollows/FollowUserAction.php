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

    // Get tweets based on list of IDs
    $payload = $this->usersRepository->followUser($user_id, $params);

    // Return response to user
    return $this
      ->respondWithData($payload)
      ->withHeader('Content-Type', 'application/json');
  }
}