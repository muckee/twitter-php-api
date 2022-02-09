<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\Mutes\ManageMutes;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

class UnmuteUserAction extends UsersAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $user_id = $this->args['user_id'];
    $target_user_id = $this->args['target_user_id'];

    // Mute user
    $payload = $this->usersRepository->unmuteUser($user_id, $target_user_id);

    // Return response to user
    return $this
      ->respondWithData($payload)
      ->withHeader('Content-Type', 'application/json');
  }
}