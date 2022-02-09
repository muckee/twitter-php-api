<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Users\Follows\FollowsLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Users\UsersAction;

class GetFollowersByUsernameAction extends UsersAction
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

    // Get tweets based on list of IDs
    $payload = $this->usersRepository->getFollowersByUsername($username, $params);

    // Return response to user
    return $this
      ->respondWithData($payload)
      ->withHeader('Content-Type', 'application/json');
  }
}