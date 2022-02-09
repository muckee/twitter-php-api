<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\Blocks\ManageBlocks;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

class BlockUserAction extends UsersAction
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

    // Block user
    $payload = $this->usersRepository->blockUser($user_id, $params);

    // Return response to user
    return $this
      ->respondWithData($payload)
      ->withHeader('Content-Type', 'application/json');
  }
}